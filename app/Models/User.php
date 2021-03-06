<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'sei',
        'mei',
        'sei_kana',
        'mei_kana',
        'tel',
        'pictureUrl',
        'email',
        'password',
        'blocked_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーはUUIDを自動で実行しない
     * ラインIDが上書きされてしまう
     */
//    protected static function boot()
//    {
//        parent::boot();
//        static::creating(function ($model) {
//            $model->{$model->getKeyName()} = (string)Uuid::generate()->string;
//            $model->{$model->getKeyName()} = (string)Str::orderedUuid();
//        });
//    }
}
