<?php

namespace App\Utilities\TimeLimitToken;

use App\Models\Token;

class TimeLimitToken
{
    protected string $limit;

    public function __construct()
    {
        $this->limit = config('app.token.time_limit');
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return (new Token)->query()->create([
            'created_by' => request()->ip(),
            'expired_at' => now()->addMinutes($this->limit),
        ])->id;
    }

    /**
     * @param string $token
     * @return void
     */
    public function use(string $token): void
    {
        $model = Token::query()->findOrFail($token);

        $model->used_by = request()->ip();
        $model->save();
    }

    /**
     * @param string $token
     * @return void
     * @throws TimeLimitTokenException
     */
    public function check(string $token): void
    {
        $model = Token::query()->findOr($token, function () {
            throw new TimeLimitTokenException(__('Not found token'));
        });

        if (isset($model->used_by)) {
            throw new TimeLimitTokenException(__('The token has already been used'));
        }

        if (now()->gt($model->expired_at)) {
            throw new TimeLimitTokenException(__('The token expired.'));
        }
    }
}
