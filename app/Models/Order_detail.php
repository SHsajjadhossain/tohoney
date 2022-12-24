<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    public function relationtouser()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
    public function relationtoproduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
