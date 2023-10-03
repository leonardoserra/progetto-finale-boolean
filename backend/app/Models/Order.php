<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function dishes(){
        return $this->belongsToMany(Dish::class)->withPivot('quantity');
    }
    protected $fillable = [
        'name_customer',
        'address_customer',
        'phone_number_customer',
        'email_customer',
        'total_price',
        'status',
    ];
}