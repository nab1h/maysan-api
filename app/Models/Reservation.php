<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'location_id',
        'branch_id',
        'department_id',
        'service_id',
        'reservation_date',
        'reservation_time',
        'status',
        'doctor_id',
        'offer_id',
        'payment_status',
        'payment_method',
        'transaction_id',
        'message',
        'notes',
        'is_archive',
        'is_delete'
    ];

    protected $casts = [
        'reservation_time' => 'datetime:H:i',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isOnlinePayment(): bool
    {
        return $this->payment_method === 'online';
    }
}
