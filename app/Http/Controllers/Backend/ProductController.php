<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([ 
            'user_id' => auth()->user()->id
        ] + $request->all());

        if ($request->file('file'))
        {
            $product->image = $request->file('file')->store('products', 'public');
            $product->save();
        }
        return back()->with('status', 'Create Success');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        if ($request->file('file'))
        {
            Storage::disk('public')->delete($product->image);

            $product->image = $request->file('file')->store('products', 'public');
            $product->save();
        }
        return back()->with('status', 'Update Success');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return back()->with('status', 'Delete Success');
    }

    public function productList()
    {
        $products = Product::orderBy('name', 'ASC')->get();
        return response($products);
    }
}