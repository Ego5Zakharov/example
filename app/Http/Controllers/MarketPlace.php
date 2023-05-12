<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use MongoDB\Driver\Query;

class MarketPlace extends Controller
{
    public function index()
    {
        $products = Product::query()->get();

        return view('market.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::query()->findOrFail($id);
        return view('market.show', compact('product'));
    }

    // TODO: лайки, комментарии, фильтр, теги
}
