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

    // public function getForDateAttribute() {
    //     return "Appril";
    // }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }
}
