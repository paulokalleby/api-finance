<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OperationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'account' => $this->account->name,
            'name'    => $this->name,
            'summary' => $this->summary,
            'cost'    => $this->cost,
            'type'    => config('enums.type')[$this->type],
            'created' => Carbon::make($this->created_at)->format('Y-m-d'),
            'updated' => $this->updated_at->diffForHumans(),
        ];
    }
}
