<?php

namespace App\Repositories\Product;


use App\Models\Product;


class ProductRespository implements ProductRepositoryInterface

{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }
    public function store($data)
    {
        return Product::create($data);
    }

    public function update($id, $data)
    {
        $product = $this->show($id);
        $product->update($data);

        return $product;
    }

    public function delete($id)
    {
        $product = $this->show($id);
        return $product->delete($id);
    }
}
