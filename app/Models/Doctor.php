<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'branch_id',
        'name',
        'image',
        'description',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
