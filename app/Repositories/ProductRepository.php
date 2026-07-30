<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::with(['bannerMedia', 'cardMedia'])->orderBy('sort_order', 'asc')->get();
    }

    public function getProductById($id)
    {
        return Product::with([
            'bannerMedia',
            'cardMedia',
            'features',
            'applications',
            'specifications'
        ])->findOrFail($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
