<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\HasAuthenticatedUser;
use OpenApi\Annotations as OA;

class LogoutController extends Controller
{
    use HasAuthenticatedUser;
    
    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     path="/auth/logout",
     *     summary="Revogar token de acesso do usuário logado",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function __invoke()
    {
        $this->getUser()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso!'
        ]);
    }

}
