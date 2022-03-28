<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_PENDING = 'pending';
    const STATUS_ADJUST = 'adjusted';
    const STATUS_ADVANCED = 'advanced';

    protected $fillable = [
        'customer_id',
        'method',
        'payload',
        'remarks',
        'logs',
        'payment_date',
        'amount',
        'adjust',
        'dues',
        'status',
    ];

    protected $casts = [
        'logs' => 'array',
        'payload' => 'array'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function setStatus()
    {
        $this->dues = $this->amount - $this->adjust;
        $status = $this->adjust == 0 ? self::STATUS_PENDING : ($this->dues == 0 ? self::STATUS_ADJUST : self::STATUS_ADVANCED);

        $this->status = $status;
        $this->save();
    }
}
