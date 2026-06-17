<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    protected $fillable = ['url', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
