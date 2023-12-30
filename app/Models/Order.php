<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Orders';

    protected $fillable = [
        'code',
        'gender',
        'name',
        'phone',
        'address',
        'requirements',
        'printInvoice',
        'pay_method',
        'VNPAYCODE',
        'amount',
        'userId',
        'status',
    ];

    public $timestamps = true;
}
