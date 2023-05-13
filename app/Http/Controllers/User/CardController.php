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

        $card = $user->card;

        if ($card) {
            if (!$card->products->contains($product)) {
                $card->products()->attach($product, ['quantity' => $quantity]);
            } else {
                $existingQuantity = $card->products->find($product)->pivot->quantity;
                $newQuantity = $existingQuantity + $quantity;
                $card->products()->updateExistingPivot($product, ['quantity' => $newQuantity]);
            }
        }
        return redirect()->route('user.card.index');
    }

    public function delete($id)
    {
//        $cardItem = Auth::user()->card()->first()->products()->findOrFail($id);
//
//        $cardItem->pivot->delete();

        $user = Auth::user();
        $card = $user->card()->first();
        if ($card) {
            $card->products()->detach($id);
        }

        return redirect()->route('user.card.index');
    }
}

