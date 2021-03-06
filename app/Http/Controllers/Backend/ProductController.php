<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $searchProduct = $request->searchProduct;
        if ($searchProduct == null) {
            $products = Product::latest()->paginate(5);
        } else {
            $products = Product::where('name', "LIKE", "%$searchProduct%")->paginate(5);
        }

        return view('products.index', compact('products', 'searchProduct'));
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
        return redirect("products")->with('status', 'Create Success');
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
        return redirect("products")->with('status', 'Update Success');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect("products")->with('status', 'Delete Success');
    }

    public function productList()
    {
        $products = Product::orderBy('name', 'ASC')->get();
        return response($products);
    }
}