<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ExpenseSplit extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'amount', 'recepient_paid'
    ];    

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
