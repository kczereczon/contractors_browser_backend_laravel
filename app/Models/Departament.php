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
        'contractor_id',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function contractor(){
        return $this->belongsTo(Contractor::class);
    }
}
