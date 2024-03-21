<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $account;

    public function __construct(AccountRepository $account)
    {
        $this->account = $account;
    }

    public function index(Request $request)
    {
        return AccountResource::collection(
            $this->account->getAll( (array) $request->all() )
        );
    }

    public function store(AccountRequest $request)
    {
        return new AccountResource(
            $this->account->create( (array) $request->validated() )
        );
    }

    public function show($id)
    {
        return new AccountResource(
            $this->account->getById($id)
        );
    }

    public function update(AccountRequest $request, $id)
    {
        return $this->account->update(
            (array) $request->validated(), $id
        );
    }

    public function destroy($id)
    {
        return $this->account->delete($id);
    }
}
