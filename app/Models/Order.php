<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(RecordPembeli::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
