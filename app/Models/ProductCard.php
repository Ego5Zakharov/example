<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCard extends Model
{
    use HasFactory;

    protected $fillable = ['total_price', 'quantity'];
    protected $table = 'card_product';
}
