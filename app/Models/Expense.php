<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'amount', 'split_numbers'
    ];    

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
