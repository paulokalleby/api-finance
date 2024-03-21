<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AccountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'summary' => $this->summary,
            'value'   => $this->value,
            'created' => Carbon::make($this->created_at)->format('Y-m-d'),
            'updated' => $this->updated_at->diffForHumans(),
        ];
    }
}
