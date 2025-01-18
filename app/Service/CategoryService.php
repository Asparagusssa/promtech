<?php

namespace App\Service;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function getAll(Request $request)
    {
        return Category::with('products')->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->get();
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
