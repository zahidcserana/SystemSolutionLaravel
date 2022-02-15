<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    const BILL_TYPE_MONTHLY = 'monthly';
    const BILL_TYPE_YEARLY = 'yearly';
    const BILL_TYPE_ONETIME = 'onetime';

    const STATUS_PENDING = 'pending';
    const STATUS_DUE = 'due';
    const STATUS_PAID = 'paid';

    protected $fillable = [
        'customer_id',
        'type',
        'for_date',
        'amount',
        'paid',
        'status',
    ];

    public static $billTypeValues = [
        self::BILL_TYPE_MONTHLY => 'Monthly',
        self::BILL_TYPE_YEARLY => 'Yearly',
        self::BILL_TYPE_ONETIME => 'Onetime',
    ];

    public function setStatus()
    {
        $status = $this->paid == 0 ? 'pending' : ($this->paid == $this->amount ? 'paid' : 'due');

        $this->status = $status;
        $this->save();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }
}
