<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'question_ar',
        'answer_ar',
        'order_column',
        'is_active',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('order_column', 'asc');
        });
    }
}
