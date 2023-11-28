<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'application' => 'nullable|string',
        ]);

        $user = User::whereEmail($request->input('email'))
            ->first();

        if ($user) {
            if (! Hash::check($request->input('password'), $user->password)) {
                throw new UnauthorizedHttpException('Invalid login credentials.', 'Invalid login credentials.');
            }

            return response()->json([
                'token' => $user->createToken($request->input('application', 'spa'))->plainTextToken,
                'user' => $user,
            ], HttpStatusCode::HTTP_OK);
        }
        throw new UnauthorizedHttpException('Invalid login credentials.', 'Invalid login credentials.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out.',
        ], HttpStatusCode::HTTP_NO_CONTENT);
    }

    public function whoami(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ], HttpStatusCode::HTTP_OK);
    }
}
