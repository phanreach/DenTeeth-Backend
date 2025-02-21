<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosis extends Model
{
    use HasFactory;
    protected $table = 'diagnoses';
    protected $fillable = ['user_id', 'symptom_data_id', 'photo'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
