<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\ImageOptimize\ImageOptimizeContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class OptimizeUserPhotoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const USER_PHOTO_WIDTH = 70;
    const USER_PHOTO_HEIGHT = 70;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected User $user){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $path = Storage::path(\str(User::PHOTO_PATH)->finish('/') . $this->user->photo);

        app(ImageOptimizeContract::class)->optimize(
            $path, $path, self::USER_PHOTO_WIDTH, self::USER_PHOTO_HEIGHT
        );
    }
}
