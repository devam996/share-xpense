<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use Notifiable;
    use SoftDeletes;

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function exenseSplits()
    {
        return $this->hasMany('App\Models\ExpenseSplit', 'expense_id');
    }
    
    protected $fillable = [
        'amount', 'category_id'
    ];    

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}

