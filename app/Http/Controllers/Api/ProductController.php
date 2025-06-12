<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        try {
            $product = Product::with(['Category:id,category'])->latest()->limit(8)->get();

            $product->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/Product/' . trim($item->img));
                return $item;
            });
            return new ProductResources(true, 'Product data fetched successfully', $product);
        } catch (\Exception $e) {
            return new ProductResources(false, 'Failed to fetch product data', null);
        }
    }

    public function index()
    {
        try {
            $product = Product::with(['Category:id,category'])->latest()->get();

            $product->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/Product/' . trim($item->img));
                return $item;
            });
            return new ProductResources(true, 'Product data fetched successfully', $product);
        } catch (\Exception $e) {
            return new ProductResources(false, 'Failed to fetch product data', null);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with(['Category:id,category'])->findOrFail($id);
            $product->img_url = asset('dist/assets/img/Product/' . trim($product->img));
            return new ProductResources(true, 'Product data fetched successfully', $product);
        } catch (\Exception $e) {
            return new ProductResources(false, 'Failed to fetch product data', null);
        }
    }

    public function search(Request $request)
    {
        try {
            $product = Product::with(['Category:id,category'])->where('title', 'LIKE', '%' . $request->title . '%')->get();
            $product->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/Product/' . trim($item->img));
                return $item;
            });
            return new ProductResources(true, 'Product data fetched successfully', $product);
        } catch (\Exception $e) {
            return new ProductResources(false, 'Failed to fetch product data', null);
        }
    }

    public function another($id)
    {
        try {
            $product = Product::with(['Category:id,category'])->where('id', '!=', $id)->limit(4)->get();
            $product->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/Product/' . trim($item->img));
                return $item;
            });
            return new ProductResources(true, 'Product data fetched successfully', $product);
        } catch (\Exception $e) {
            return new ProductResources(false, 'Failed to fetch product data', null);
        }
    }

    public function recommend()
    {
        try {
            $product = Product::with(['Category:id,category'])->inRandomOrder()->select('id', 'title', 'img','category_id')->limit(4)->get();
            $product->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/Product/' . trim($item->img));
                return $item;
            });
            return new ProductResources(true, 'Product data fetched successfully', $product);
        } catch (\Exception $e) {
            return new ProductResources(false, 'Failed to fetch product data', null);
        }
    }
}
