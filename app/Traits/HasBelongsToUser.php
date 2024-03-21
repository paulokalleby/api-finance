<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait HasBelongsToUser
{
    protected static function bootHasBelongsToUser()
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

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
