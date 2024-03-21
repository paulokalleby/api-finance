<?php

namespace App\Http\Controllers\Finance;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return UserResource::collection(
            $this->repository->getAll( 
                (array) $request->all() 
            )
        );
    }

    public function store(UserRequest $request)
    {
        return new UserResource(
            $this->repository->create( 
                (array) $request->validated() 
            )
        );
    }

    public function show(string $id)
    {
        return new UserResource(
            $this->repository->getById($id)
        );
    }

    public function update(UserRequest $request, string $id)
    {
        return $this->repository->update(
            (array) $request->validated(), $id
        );
    }

    public function destroy(string $id)
    {
        return $this->repository->delete($id);
    }
}
