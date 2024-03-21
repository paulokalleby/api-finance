<?php

namespace App\Models;

use App\Traits\HasBelongsToUser;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory, HasUuids, HasBelongsToUser;

    protected $fillable = [
        'user_id',
        'name',
        'summary',
        'value',
    ];

    /*
    public function setValueAttribute($attr)
    {
        return $this->attributes['value'] = str_replace(",", ".", str_replace(".", "", $attr));
    }
    */

    public function operations() : HasMany
    {
        return $this->hasMany(Operation::class);
    }
}
