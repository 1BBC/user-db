<?php

namespace Tests\Feature;

use App\Jobs\OptimizeUserPhotoJob;
use App\Models\Position;
use App\Models\Token;
use App\Models\User;
use App\Utilities\TimeLimitToken\TimeLimitToken;
use Database\Seeders\PositionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PositionApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_user(): void
    {
        Storage::fake('public');

        $position = Position::factory()->create();
        $user = User::factory()->create([
            'position_id' => $position->id,
        ]);

        $response = $this->getJson('/api/v1/users/'.$user->id);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'position' => $position->name,
                'position_id' => $position->id,
                'photo' => $user->photo_url,
            ],
        ]);
    }

    public function test_show_users(): void
    {
        Storage::fake('public');

        $count = config('app.user.per_page');
        $totalUsers = 15;
        $page = 2;
        $this->seed(PositionSeeder::class);
        $users = User::factory($totalUsers)->create();

        $response = $this->getJson(
            '/api/v1/users/?' . http_build_query(['page' => $page, 'count' => $count])
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'page',
            'total_pages',
            'total_users',
            'count',
            'links' => [
                'next_url', 'prev_url'
            ],
            'users' => [
                [
                    'id', 'name', 'email', 'phone', 'position', 'position_id', 'photo'
                ]
            ],
        ]);
        $response->assertJsonCount($count, 'users');
        $this->assertEquals($count, $response->json('count'));
        $this->assertEquals($page, $response->json('page'));
        $this->assertEquals($totalUsers, $response->json('total_users'));
    }

    public function test_user_can_be_validated(): void
    {
        Storage::fake('public');

        $this->seed();
        $response = $this->getJson(
            '/api/v1/users/?' . http_build_query(['page' => 0, 'count' => 'string'])
        );

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'success',
            'message',
            'fails' => [
                'count', 'page'
            ],
        ]);

        $this->assertEquals('Validation failed', $response->json('message'));
        $this->assertEquals('The count must be an integer.', $response->json('fails.count.0'));
        $this->assertEquals('The page must be at least 1.', $response->json('fails.page.0'));
    }

    public function test_user_can_be_stored(): void
    {
        Storage::fake('public');
        Queue::fake();

        /* @var TimeLimitToken $tlt */
        $tlt = app(TimeLimitToken::class);
        $token = $tlt->get();
        $position = Position::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg',70, 70);

        $response = $this->postJson('/api/v1/users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '+380123456789',
            'position_id' => $position->id,
            'photo' => $file,
        ], ['Token' => $token]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'user_id',
            'message',
        ]);
        $this->assertEquals('New user successfully registered', $response->json('message'));

        $user = User::query()->find($response->json('user_id'));

        Storage::disk('public')->assertExists(
            str(User::photoPath())->finish('/').$user->photo, $file->getContent()
        );

        $tokenModel = Token::query()->find($token);

        $this->assertEquals(request()->ip(), $tokenModel->used_by);
        Queue::assertPushed(OptimizeUserPhotoJob::class);
    }
}
