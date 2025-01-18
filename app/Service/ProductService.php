<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    public function getAll(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        return Product::with('category')->orderBy('title')->paginate($perPage);
    }

    public function getOne($product_id)
    {
        return Product::with('category')->find($product_id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $product_id)
    {
        $product = Product::find($product_id);
        $product->update($data);
        return $product->load('category');
    }

    public function delete($product_id): void
    {
        $product = Product::find($product_id);
        $product->delete();
    }
}
