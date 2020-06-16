<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'stores';

    protected $fillable = [
        'id',
        'name',
        'address',
        'tel',
        'url',
        'business_hours',
        'color_code',
        'created_at',
        'updated_at',
    ];

}
