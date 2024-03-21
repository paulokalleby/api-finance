<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationRequest;
use App\Http\Resources\OperationResource;
use App\Repositories\OperationRepository;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    protected $operation;

    public function __construct(OperationRepository $operation)
    {
        $this->operation = $operation;
    }

    public function index(Request $request)
    {
        return OperationResource::collection(
            $this->operation->getAll( 
                (array) $request->all() 
            )
        );
    }

    public function store(OperationRequest $request)
    {
        return new OperationResource(
            $this->operation->create(
                (array) $request->validated() 
            )
        );
    }

    public function show($id)
    {
        return new OperationResource(
            $this->operation->getById($id)
        );
    }

    public function update(OperationRequest $request, $id)
    {
        return $this->operation->update(
            (array) $request->validated(), $id
        );
    }

    public function destroy($id)
    {
        return $this->operation->delete($id);
    }
}
