<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Product;
use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $card = $user->card;

        return view('user.card.index', compact('card'));
    }

    public function create($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        if ($quantity > $product->stock) {
            return back();
        }

        $card = $user->card;


        if (!$card->products->contains($product)) {
            $card->products()->attach($product, ['quantity' => $quantity]);

            $product->stock = $product->stock - $quantity;


            $product->save();
        } else {
            $existingQuantity = $card->products->find($product)->pivot->quantity;
            $newQuantity = $existingQuantity + $quantity;
            $card->products()->updateExistingPivot($product, ['quantity' => $newQuantity]);

            $product->stock = $product->stock - $quantity;
            $product->save();
        }

        return redirect()->route('user.card.index');
    }

    public function delete($id)
    {
        $user = Auth::user();
        $card = $user->card()->first();

        if ($card) {
            $product = $card->products()->findOrFail($id);

            // в корзине
            $productQuantity = $product->pivot->quantity;

            // добавление к количества продукта при удалении из корзины
            $product->stock += $productQuantity;
            $product->save();

            $card->products()->detach($id);
        }
        return redirect()->route('user.card.index');
    }
}

