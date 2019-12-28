<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];    

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
