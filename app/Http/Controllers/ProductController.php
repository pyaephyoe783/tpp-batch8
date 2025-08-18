<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->get();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('ProductsImage'), $imageName);

            // dd($imageName);

        }

        Product::create([

            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'category_id' => $request->category_id,
        ]);



        return redirect()->route('products.index')->with('success');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));

    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price, 
                'category_id' => $request->category_id,
            ]
        );

        return redirect()->route('products.index')->with('edit success');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('delete success');
    }
}
