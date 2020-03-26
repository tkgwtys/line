<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

class Player extends Model
{
    //
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'players';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)Uuid::generate()->string;
            $model->{$model->getKeyName()} = (string)Str::orderedUuid();
        });
    }
}
