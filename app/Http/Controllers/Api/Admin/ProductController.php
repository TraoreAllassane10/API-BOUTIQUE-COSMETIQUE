<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\ProductRessource;
use App\Repositories\ProductRespository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        public ProductService $productService
    ) {}

    public function index(Request $request)
    {
        return $this->productService->all();
    }

    public function show(string $id)
    {
        return $this->productService->find($id);
    }

    public function store(ProductStoreRequest $request)
    {
        return $this->productService->create($request);
    }

    public function update(ProductStoreRequest $request, string $id)
    {
       return $this->productService->update($request, $id);
    }

    public function delete(string $id)
    {
        return $this->productService->delete($id);
    }
}
