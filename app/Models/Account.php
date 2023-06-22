<?php

namespace App\Models;

use App\Traits\Client;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, HasUuids, Client;

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

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
