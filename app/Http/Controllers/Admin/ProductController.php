<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();

        return view('admin.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::query()->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $options = ['No', 'Yes'];
        return view('admin.products.create', compact('options'));
    }

    public function store(Request $request)
    {
        $validated = Product::getRules($request);

        $path = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
        }

        $product = Product::query()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'published_at' => $validated['published_at'],
            'published' => $validated['published'] ?? false,
            'image' => $path,
        ]);

        return redirect()->route('admin.products.show', $product);
    }


    public function edit($id)
    {
        $product = Product::query()->findOrFail($id);
        $options = ['No', 'Yes'];
        return view('admin.products.edit', compact('product', 'options'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = Product::getRules($request);

        $path = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
        }

        $product->fill([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'published' => $validated['published'] ?? false,
            'published_at' => new Carbon($validated['published_at']) ?? null,
            'image' => $path,
        ]);
        $product->save();

        return redirect()->route('admin.products.show', $product);
    }

    public function delete($id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
