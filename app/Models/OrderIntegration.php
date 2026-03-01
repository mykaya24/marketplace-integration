<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderIntegration extends Model
{
    protected $fillable = ["order_id","system_name","status"];
}
