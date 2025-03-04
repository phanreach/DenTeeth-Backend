<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointments extends Model
{
    Use HasFactory;
    protected $table = "appointments";
    protected $fillable = ['user_id' , 'service_id', 'status'];

}
