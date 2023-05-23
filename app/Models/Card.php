<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Query;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'user_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity')->withPivot('total_price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCardSum()
    {
        $user = Auth::user();
        $products = $user->card->products()->get();

        return number_format($this->products()->sum('total_price'), 0, '', '');
    }

    public function getProductTotalPriceCard($productId)
    {
        $product = $this->products()->find($productId);

        if ($product) {
            $totalPrice = $product->price * $product->pivot->quantity;
            $this->products()->updateExistingPivot($productId, ['total_price' => $totalPrice]);
            $product->save();
            return $totalPrice;
        }
        return 0;
    }

    public
    function getProductQuantity($productId)
    {
        $product = $this->products()->find($productId);
        if ($product) {
            return $product->pivot->quantity;
        }
    }
}
