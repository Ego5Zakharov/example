<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');

        $products = Product::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('price', 'like', '%' . $search . '%')
            ->orWhereHas('categories', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(12);

        return view('market.index', compact('products', 'search'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $product = Product::query()->findOrFail($id);
        $feedbacks = $product->feedbacks;

        $hasFeedback = $feedbacks->contains('user_id', $user->id);

        $product = Product::query()->findOrFail($id);
        return view('market.show', compact('product', 'feedbacks', 'hasFeedback', 'user'));
    }

    // TODO: лайки, комментарии, теги
}
