<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'national_id',
        'branch_id',
        'service_id',
        'amount',
        'status',
        'transaction_id',
        'return_url',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
