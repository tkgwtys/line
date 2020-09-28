<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'users';

    private static $level = [
        10 => '一般',
        20 => 'トレーナー',
    ];

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
        'sei_hira',
        'mei_hira',
        'tel',
        'email',
        'password',
        'blocked_at',
    ];

    public static function getLevelAll()
    {
        return self::$level;
    }

    public function getLevel($level = 10)
    {
        return self::$level[$level];
    }

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


    public function getNotes($id)
    {
        return DB::table('notes')
            ->join('users', 'users.id', '=', 'notes.user_id')
            ->join('admins', 'admins.id', '=', 'notes.admin_id')
            ->select('users.*', 'admins.*', 'notes.*', 'notes.created_at as note_created_at')
            ->orderBy('notes.created_at', 'desc')
            ->where('deleted_at', '=', null)
            ->paginate(5);
    }

    /**
     * 有効なお友達だけ取得
     * @return \Illuminate\Support\Collection
     */
    public static function getUsers($level = 10)
    {
        return DB::table('users')->where('level', $level)->whereNull('blocked_at')->get();
    }

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
