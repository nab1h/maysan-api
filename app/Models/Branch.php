<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['location_id', 'name', 'image', 'phone', 'instagram_url', 'google_map_url', 'address'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'branch_department');
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function reels()
    {
        return $this->hasMany(Reel::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
