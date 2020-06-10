<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'courses';

    protected $fillable = [
        'id',
        'name',
        'price',
        'total_price',
        'month_count',
        'course_time',
        'description',
        'created_at',
        'updated_at',
    ];

}
