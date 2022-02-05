<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    const BILL_TYPE_MONTHLY = 'monthly';
    const BILL_TYPE_YEARLY = 'yearly';
    const BILL_TYPE_BOTH = 'both';
    const BILL_TYPE_ONETIME = 'onetime';

    const BILL_TYPES = [
        self::BILL_TYPE_MONTHLY => 'Monthly',
        self::BILL_TYPE_YEARLY => 'Yearly',
        self::BILL_TYPE_BOTH => 'both',
        self::BILL_TYPE_ONETIME => 'Onetime',
    ];


    protected $guarded = [];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
