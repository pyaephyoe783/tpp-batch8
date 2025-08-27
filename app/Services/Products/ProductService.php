<?php

namespace App\Services\Products;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function status($id)
    {
        $product = $this->productRepository->show($id);

        $newStatus = $product->status == 1 ? 0 : 1;

        $this->productRepository->update($id, ['status' => $newStatus]);
    }
}
