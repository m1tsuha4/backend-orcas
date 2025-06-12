<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResources;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::select('id', 'category')->get();
            return new CategoryResources(true, 'Category data fetched successfully', $categories);
        } catch (\Exception $e) {
            return new CategoryResources(false, 'Failed to fetch category data', null);
        }
    }
}
