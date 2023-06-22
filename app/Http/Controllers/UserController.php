<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        return UserResource::collection(
            $this->user->getAllUsers( (array) $request->all() )
        );
    }

    public function store(UserRequest $request)
    {
        return new UserResource(
            $this->user->createUser( (array) $request->validated() )
        );
    }

    public function show($id)
    {
        return new UserResource(
            $this->user->getUserById($id)
        );
    }

    public function update(UserRequest $request, $id)
    {
        return $this->user->updateUser(
            (array) $request->validated(), $id
        );
    }

    public function destroy($id)
    {
        return $this->user->deleteUser($id);
    }
}
