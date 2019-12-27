<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'name','amount_due', 'amount_owe', 'amount_paid','email'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
