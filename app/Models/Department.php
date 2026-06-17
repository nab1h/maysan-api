<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_department');
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
