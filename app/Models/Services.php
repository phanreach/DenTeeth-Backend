<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Services extends Model
{
    Use HasFactory;
    protected $table = 'services';
    protected $filable = ['service_name' , 'description' , 'cost'];

    
}


