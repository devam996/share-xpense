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

    public function groupUsers()
    {
        return $this->hasMany('App\Models\GroupUser', 'group_id');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\Expense', 'group_id');
    }

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
