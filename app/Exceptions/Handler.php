<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|void
     */
    public function render($request, Throwable $e)
    {
        if ($request->expectsJson() || $this->isApiRoute($request)) {
            return $this->handleJsonResponse($e);
        }
    }

    /**
     * @param Throwable $exception
     * @return JsonResponse
     */
    protected function handleJsonResponse(Throwable $exception): JsonResponse
    {
        $statusCode = $this->getStatusCode($exception);
        $response = [
            'error' => [
                'code' => $statusCode,
                'message' => $exception->getMessage(),
            ]
        ];

        return new JsonResponse($response, $statusCode);
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function isApiRoute($request): mixed
    {
        return $request->is('api/*'); // Adjust the route prefix to match your API routes
    }

    /**
     * @param Throwable $exception
     * @return int
     */
    protected function getStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return 500; // Default status code for server errors
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
