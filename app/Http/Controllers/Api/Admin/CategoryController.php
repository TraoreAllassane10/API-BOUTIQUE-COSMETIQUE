<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Services\CategoryService;


class CategoryController extends Controller
{
    public function __construct(
        public CategoryService $categoryService
    )
    {}

    public function index()
    {
        return $this->categoryService->all();
    }

    public function show(string $id)
    {
        return $this->categoryService->find($id);
    }

    public function store(CategoryStoreRequest $request)
    {
       return $this->categoryService->create($request);
    }

    public function update(CategoryStoreRequest $request, string $id)
    {
        return $this->categoryService->update($id, $request);
    }

    public function delete(string $id)
    {
        return $this->categoryService->delete($id);
    }
}
