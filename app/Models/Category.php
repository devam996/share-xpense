<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'title'
    ];

    protected $attributes = [
        'type' => 'CUSTOM',
    ];

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
