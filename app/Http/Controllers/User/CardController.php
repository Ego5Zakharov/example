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

    public function create($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $card = $user->card()->first();

        if (!$card) {
            $card = new Card();
            $card->user_id = $user->id;
            $card->save();
        }

        $card->products()->attach($product);

        return redirect()->route('user.card.index');
    }

    public function delete($id)
    {
        $user = Auth::user();
        $card = $user->card()->first();
        if ($card) {
            $card->products()->detach($id);
        }

        return redirect()->route('user.card.index');
    }
}

