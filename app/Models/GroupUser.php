<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'amount_due', 'amount_owe', 'amount_paid'    
    ];

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
