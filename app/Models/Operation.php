<?php

namespace App\Models;

use App\Traits\Client;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory, HasUuids, Client;

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

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}
