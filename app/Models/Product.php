<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
        'price', 'image',
        'published', 'published_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'published' => 'boolean',
        'published_at' => 'datetime'
    ];


    public static function getRules(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:200'],
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:100'],
            'published_at' => ['nullable', 'string', 'date'],
            'published' => ['nullable', 'boolean'],
            'image' => ['sometimes', 'image:jpg,jpeg,png'],
        ]);
    }

    public function setProductImageWithModel(Product $product)
    {
        $imageUrl = asset('storage/' . $product->image);
        $product->image = $imageUrl;
        return $product;
    }

    public function setProductImageWithId(int $id)
    {
        $product = Product::query()->findOrFail($id);

        $imageUrl = asset('storage/' . $product->image);
        $product->image = $imageUrl;

        return $product;
    }

    public function card()
    {
        return $this->belongsToMany(Card::class);
    }
}
