<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
