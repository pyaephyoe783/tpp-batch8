<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(StoreProductRequest $request){
            // $inputData = $request->validate(
            //     [
            //     'name' => 'required|string|max:255',
            //     'description' => 'required|string',
            //     'price' => 'required|numeric|min:1'
            //     ]

            //     );


            Product::create($request->validated());

            return redirect()->route('products.index')->with('success');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('products.edit',compact('product'));
    }

    public function update(Request $request,$id){
        $product = Product::find($id);
        $product -> update ([
            'name'=> $request->name,
            'description' => $request->description,
            'price' => $request->price]
        );

        return redirect()->route('products.index')->with('edit success');
    }

    public function delete($id){
        $product = Product::find($id);
        $product -> delete();
        return redirect()->route('products.index')->with('delete success');
    }
}
