<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'phone', 'comment', 'glasses_model'];

    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
