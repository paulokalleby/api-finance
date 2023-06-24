<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Repositories\AccountRepository;
use App\Repositories\OperationRepository;
use App\Repositories\UserRepository;
use PhpParser\Node\Expr\Cast\Object_;

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
           ['index' => 1, 'resource' => 'Contas', 'count' => $this->account->totalAccounts()],
           ['index' => 2, 'resource' => 'Operações','count' => $this->operation->totalOperations()],
           ['index' => 3 , 'resource' => 'Usuários ativos', 'count' => $this->user->totalUsers(),],
        ]];

        return response()->json($metrics);
    }
}
