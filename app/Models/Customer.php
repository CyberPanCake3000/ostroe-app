<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerInfo;
use App\Models\Order;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_info_id', 'comment', 'phone'];

    public function getCustomerInfo()
    {
        return $this->belongsTo(CustomerInfo::class, 'customer_info_id');
    }

    public function getOrders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
