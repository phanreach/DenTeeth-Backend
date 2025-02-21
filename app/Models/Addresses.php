<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Addresses extends Model
{
    Use HasFactory;
    protected $table = 'addresses';
    protected $fillable = ['house_number',
                            'street_name',
                            'street_number',
                            'commune',
                            'district',
                            'province',
                            'city',
                            'postal_code'];
}
