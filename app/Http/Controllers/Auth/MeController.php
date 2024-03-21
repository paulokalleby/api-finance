<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\HasAuthenticatedUser;
use OpenApi\Annotations as OA;

class MeController extends Controller
{
    use HasAuthenticatedUser;

    /**
     * @OA\Get(
     *     tags={"Auth"},
     *     path="/auth/me",
     *     summary="Consultar usuário autenticado",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function __invoke()
    {
        return new UserResource(
            $this->getUser()
        );
    }
}
