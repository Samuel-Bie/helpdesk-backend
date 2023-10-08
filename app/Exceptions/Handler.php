<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use App\Exceptions\ApiExceptionTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiExceptionTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }



    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        /*
We will verify if its coming by api or is expecting json
            */
        if ($request->is('api/*') or $request->expectsJson()) {
            return $this->handleApiException($request, $e);
        }
        return parent::render($request, $e);
    }
}
