<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;

class AccountRepository
{    
    protected $account;

    public function __construct(Account $model)
    {
        $this->account = $model;
    }

    public function getAll(array $filters = [])
    {
        $query =  $this->account->when($filters, function ( Builder $query ) use ( $filters ) {

            if ( isset($filters['name']) )   $query->where('name', 'LIKE', "%{$filters['name']}%");
                
        });

        if ( 
            isset( $filters['paginate'] ) && 
            is_numeric( $filters['paginate'] ) 
        )  
            return $query->paginate( $filters['paginate'] );
        else 
            return $query->get();
    }

    public function getById(string $id)
    {
        return $this->account->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->account->create($data);
    }

    public function update(array $data, string $id)
    {
        $account = $this->account->findOrFail($id);

        $account->update($data);

        return response()->json([
            'message' => 'success'
        ], 204);
    }

    public function delete(string $id)
    {
        $account = $this->account->findOrFail($id);
        
        $account->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function count()
    {
        return  $this->account->count();
    }
}
