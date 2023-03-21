<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'phone', 'name', 'birth_date', 'OD_Sph', 'OD_Cyl', 'OD_ax', 'OS_Sph', 'OS_Cyl', 'OS_ax', 'Dpp'];

    public function getOrders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
