<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{    
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers(array $filters = [])
    {
        return  $this->user->when($filters, function (Builder $query) use ($filters) {

            if ( isset($filters['name']) ) $query->where('name', 'LIKE', "%{$filters['name']}%");

            if ( isset($filters['active']) ) $query->whereActive($filters['active']);
            
            else $query->whereActive(true); 
                
        })->paginate();
    }

    public function getUserById(string $id)
    {
        return $this->user->findOrFail($id);
    }

    public function createUser(array $users)
    {
        $users['password'] = bcrypt($users['password']);

        return $this->user->create($users);
    }

    public function updateUser(array $users, string $id)
    {
        $user = $this->user->findOrFail($id);

        if ( isset($users['password']) ) {
            $users['password'] = bcrypt($users['password']);
        }

        $user->update($users);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function deleteUser(string $id)
    {
        $user = $this->user->findOrFail($id);

        if ( $user->isSuperAdmin() ) abort(403, 'not authorized');

        $user->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function totalUsers()
    {
        return  $this->user->whereActive(true)->count();
    }
}
