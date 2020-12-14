<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    protected $dates = ['join_date'];
    protected $fillable = [
        'name',
        'nip',
        'join_date'
    ];

    public function departaments()
    {
        return $this->hasMany(Departament::class);
    }
}
