<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'amount', 'coins', 'txn_id', 'description', 'screenshot', 'user_id','cash_type','currency','ether'

    ];

    /**
     * The user for corresponding transaction.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
