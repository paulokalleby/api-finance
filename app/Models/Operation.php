<?php

namespace App\Models;

use App\Traits\HasBelongsToUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    use HasFactory, HasUuids, HasBelongsToUser;

    protected $fillable = [
        'user_id',
        'account_id',
        'name',
        'summary',
        'type',
        'cost',
    ];

        /*
    public function setCostAttribute($attr)
    {
        return $this->attributes['cost'] = str_replace(",", ".", str_replace(".", "", $attr));
    }
    */

    public function account() : BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

}
