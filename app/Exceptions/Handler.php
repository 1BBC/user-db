<?php

namespace App\Exceptions;

use App\Utilities\TimeLimitToken\TimeLimitTokenException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->renderable(function (\Exception $e, Request $request) {
            if (!$request->is('api/*')) {
               return false;
            }

            if ($e instanceof ValidationException) {
                throw new ApiDefaultException(__('Validation failed'), $e->status, $e->errors());
            }

            if ($e instanceof NotFoundHttpException) {
                throw new ApiDefaultException(__('Page not found'), 404);
            }

            if ($e instanceof TimeLimitTokenException) {
                throw new ApiDefaultException($e->getMessage(), 401);
            }

            if ($e instanceof PostTooLargeException) {
                throw new ApiDefaultException('Content Too Large', 413);
            }

            if (!config('app.debug')) {
                throw new ApiDefaultException(__('Unknown server error'), 520);
            }

            return false;
        });
    }
}
