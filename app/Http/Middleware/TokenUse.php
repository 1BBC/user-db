<?php

namespace App\Http\Middleware;

use App\Utilities\TimeLimitToken\TimeLimitToken;
use App\Utilities\TimeLimitToken\TimeLimitTokenException;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenUse
{
    public function __construct(protected TimeLimitToken $token) {}

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     * @throws TimeLimitTokenException
     */
    public function handle(Request $request, Closure $next)
    {
        $this->token->check((string)$request->header('Token'));

        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     *
     * @param  Request  $request
     * @param JsonResponse|Response $response
     * @return void
     */
    public function terminate(Request $request, JsonResponse|Response $response): void
    {
        if ($response->status() === 200) {
            $this->token->use((string)$request->header('Token'));
        }
    }
}
