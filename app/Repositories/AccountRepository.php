<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;

class AccountRepository
{    
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function getAllAccounts(array $filters = [])
    {
        return  $this->account->when($filters, function (Builder $query) use ($filters) {

            if ( isset($filters['name']) ) $query->where('name', 'LIKE', "%{$filters['name']}%");
        
        })->paginate();
    }

    public function getAccountById(string $id)
    {
        return $this->account->findOrFail($id);
    }

    public function createAccount(array $data)
    {

        return $this->account->create($data);
    }

    public function updateAccount(array $data, string $id)
    {
        $account = $this->account->findOrFail($id);

        $account->update($data);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function deleteAccount(string $id)
    {
        $account = $this->account->findOrFail($id);

        $account->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
