<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;

class OperationRepository
{    
    protected $operation;
    protected $account;

    public function __construct(
        Operation $operation, 
        Account $account
    )
    {
        $this->operation = $operation;
        $this->account   = $account;
    }

    public function getAll(array $filters = [])
    {
        $query =  $this->operation->when($filters, function ( Builder $query ) use ( $filters ) {

            if ( isset($filters['account_id']) ) $query->whereAccountId($filters['account_id']);

            if ( isset($filters['name']) )       $query->where('name', 'LIKE', "%{$filters['name']}%");
                
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
        return $this->operation->findOrFail($id);
    }

    public function create(array $data)
    {
        $account = $this->account->findOrFail($data['account_id']);

        if ($data['type'] == 'input') {

            $account->value += $data['cost'];

        } elseif($data['type'] == 'output') {

            $account->value -= $data['cost']; 

        }
         
        $account->save();

        return $this->operation->create($data);
    }

    public function update(array $data, string $id)
    {
        $operation = $this->operation->findOrFail($id);
        $account   = $this->account->findOrFail($data['account_id']);

        if ($operation->type == 'input') {
        
            if ($data['type'] == 'input') {

                $account->value += ( $data['cost'] - $operation->cost );
            
            } elseif($data['type'] == 'output') {

                $account->value -= ( $data['cost'] - $operation->cost ); 

            }
           
        } elseif($operation->type == 'output') {

            if ($data['type'] == 'input')  {

                $account->value += ( $data['cost'] + $operation->cost) ;
            
            } elseif($data['type'] == 'output') {

                $account->value -= ( $data['cost'] + $operation->cost ); 

            } 
        }

        $account->save();

        $operation->update($data);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function delete(string $id)
    {
        $operation = $this->operation->findOrFail($id);
        $account   = $this->account->findOrFail($operation->account_id);

        if ( $operation->type == 'input' ) {

            $account->value -= $operation->cost;

        } elseif( $operation->type == 'output') {
            
            $account->value += $operation->cost;

        } 

        $account->save();

        $operation->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function count()
    {
        return  $this->operation->count();
    }
}
