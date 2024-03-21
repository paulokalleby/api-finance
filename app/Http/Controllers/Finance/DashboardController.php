<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Repositories\AccountRepository;
use App\Repositories\OperationRepository;
use App\Repositories\UserRepository;

class DashboardController extends Controller
{
    protected $account;
    protected $operation;
    protected $user;

    public function __construct(
        AccountRepository $account,
        OperationRepository $operation,
        UserRepository $user,
    ) {
        $this->account   = $account;
        $this->operation = $operation;
        $this->user      = $user;
    }

    public function index()
    {
        $metrics = ['data' => [
           ['index' => 1,  'resource' => 'Contas', 'count' => $this->account->count()],
           ['index' => 2,  'resource' => 'Operações','count' => $this->operation->count()],
           ['index' => 3 , 'resource' => 'Usuários ativos', 'count' => $this->user->count()],
        ]];

        return response()->json($metrics);
    }
}
