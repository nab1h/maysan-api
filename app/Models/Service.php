<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'name', 'image', 'price', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

}
