<?php

namespace App\Http\Controllers;

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
            $this->operation->getAllOperations( (array) $request->all() )
        );
    }

    public function store(OperationRequest $request)
    {
        return new OperationResource(
            $this->operation->createOperation( (array) $request->validated() )
        );
    }

    public function show($id)
    {
        return new OperationResource(
            $this->operation->getOperationById($id)
        );
    }

    public function update(OperationRequest $request, $id)
    {
        return $this->operation->updateOperation(
            (array) $request->validated(), $id
        );
    }

    public function destroy($id)
    {
        return $this->operation->deleteOperation($id);
    }
}
