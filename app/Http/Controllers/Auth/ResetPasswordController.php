<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

class ResetPasswordController extends Controller
{
    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/auth/reset-password",
     *     summary="Realizar alteração de senha",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="token", type="string"),
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function (User $user, string $password) {

                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event( new PasswordReset($user) );
                
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? response()->json(['status' => __($status)])
                    : response()->json(['email'  => [__($status)]], 422);

    }
}
