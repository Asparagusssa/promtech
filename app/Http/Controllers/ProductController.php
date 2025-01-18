<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $products = $this->productService->getAll($request);
            return new ProductCollection($products);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching products.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        try {
            $product = $this->productService->create($data);
            return new ProductResource($product);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating products.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $this->productService->getOne($product->id);
        return new ProductResource($product);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        try {
            $product = $this->productService->update($data, $product->id);
            return new ProductResource($product);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating products.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->delete($product->id);
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating products.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
