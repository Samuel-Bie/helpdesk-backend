<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

trait ApiExceptionTrait
{
    //create an method to handle api exceptions


    /**
     * Return a new response from the application.
     *
     * @param  mixed  $request
     * @param  mixed  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory | \Symfony\Component\HttpFoundation\Response;
     */

    public function handleApiException($request, $exception): Response
    {
        if ($exception instanceof AuthenticationException) {
            return response()->json([
                "message" => $exception->getMessage(),
            ], HttpStatusCode::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                "message" => 'Resource not found'
            ], HttpStatusCode::HTTP_NOT_FOUND);
        }

        if ($exception instanceof UnprocessableEntityHttpException) {
            return response()->json([
                "message" => $exception->getMessage(),
            ], HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }


        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                "message" => 'Url not found'
            ], HttpStatusCode::HTTP_NOT_FOUND);
        }


        if ($exception instanceof AccessDeniedHttpException) {
            return response()->json([
                "message" => 'You do not have enough permissions to perform this action.'
            ], HttpStatusCode::HTTP_FORBIDDEN);
        }
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                "message" =>$exception->getMessage()
            ], HttpStatusCode::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof BadRequestHttpException) {
            return response()->json([
                "message" => 'Bad request'
            ], HttpStatusCode::HTTP_BAD_REQUEST);
        }


        if ($exception instanceof ConflictHttpException) {
            return response()->json([
                "message" => 'The request could not be completed due to a conflict.'
            ], HttpStatusCode::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                "message" => 'Method not allowed request'
            ], HttpStatusCode::HTTP_METHOD_NOT_ALLOWED);
        }


        if ($exception instanceof TooManyRequestsHttpException) {
            return response()->json([
                "message" => 'Too Many Requests'
            ], HttpStatusCode::HTTP_BAD_REQUEST);
        }

        return parent::render($request, $exception);
    }
}
