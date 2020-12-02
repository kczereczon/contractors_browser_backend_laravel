<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'street',
        'city',
        'country',
        'postal_code',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
