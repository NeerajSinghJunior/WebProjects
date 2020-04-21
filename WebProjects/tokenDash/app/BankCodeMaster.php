<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankCodeMaster extends Model 
{
    protected $table = 'bank_code_master';
    protected $fillable=['bank_code','status'];
}
