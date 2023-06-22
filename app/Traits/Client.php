<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait Client
{
    protected static function bootClient()
    {
        static::creating(function (Model $model) {

            if ( Auth::check() && !Auth::user()->admin ) {

                $model->user_id = Auth::user()->id;
            }
        });

        static::addGlobalScope('user_id', function (Builder $builder) {

            if ( Auth::check() && !Auth::user()->admin ) {

                $builder->where('user_id', Auth::user()->id);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
