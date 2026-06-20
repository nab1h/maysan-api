<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'sender_name',
        'sender_national_id',
        'sender_phone',
        'sender_email',
        'recipient_name',
        'recipient_phone',
        'message',
        'amount',
        'status',
        'transaction_id',
        'return_url',
        'consumed_at',
        'consumed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'consumed_at' => 'datetime',
    ];

    public function isConsumed(): bool
    {
        return $this->consumed_at !== null;
    }
}
