<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;
use OpenApi\Annotations as OA;

class ForgotPasswordController extends Controller
{
    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/auth/forgot-password",
     *     summary="Solicitar recuperação de senha",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function __invoke(ForgotPasswordRequest $request)
    {        
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['status' => __($status)])
                    : response()->json(['email'  => __($status)], 422);
    }
}
