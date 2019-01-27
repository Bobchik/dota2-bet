<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = ['name', 'refill', 'service', 'card-name', 'card-number'];
}
