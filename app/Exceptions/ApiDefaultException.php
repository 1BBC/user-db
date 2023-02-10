<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class ApiDefaultException extends Exception
{
    protected mixed $fails;

    protected int $status;

    /**
     * @return mixed
     */
    public function fails(): mixed
    {
        return $this->fails;
    }

    /**
     * @return int
     */
    public function status(): int
    {
        return $this->status ?? 200;
    }

    public function __construct($message, $status = null, $fails = null)
    {
        $this->message = $message;
        $this->status = $status;
        $this->fails = $fails;

        parent::__construct($message);
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  Request  $request
     * @return Response
     */
    public function render(Request $request): Response
    {
        return response($this->responseContent(), $this->status());
    }

    /**
     * @return array
     */
    protected function responseContent(): array
    {
        $response = [
            'success' => false,
            'message' => $this->getMessage(),
        ];

        if (isset($this->fails)) {
            $response = Arr::add($response, 'fails', $this->fails());
        }

        return $response;
    }
}
