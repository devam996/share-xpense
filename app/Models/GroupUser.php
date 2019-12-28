<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'amount_due', 'amount_owe', 'amount_paid'    
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
