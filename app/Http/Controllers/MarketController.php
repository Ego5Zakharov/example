<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $product = Product::query()->findOrFail($id);
        return view('market.show', compact('product'));
    }

    // TODO: лайки, комментарии, теги
}
