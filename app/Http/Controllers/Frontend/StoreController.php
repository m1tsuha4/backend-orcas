<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $page = 'Store';
        $categories = Category::all();
        // $stores = Store::with('rCategory')->get();
        $stores = Store::with('rCategory')->get()->sortBy(function ($store) {
            $address = $store->address;

            if (stripos($address, 'dasar') !== false || stripos($address, 'GF') !== false) {
                return 0;
            }

            if (preg_match('/Lantai\s*(\d+)/i', $address, $matches)) {
                return (int) $matches[1];
            }

            return 999;
        })->values();
        return view('frontend.pages.Store.index', compact('page', 'categories', 'stores'));
    }

    public function show($id)
    {
        $page = 'Store';
        $stores = Store::with('rCategory')->inRandomOrder()->limit(6)->get();
        $store = Store::with('rCategory')->find($id);
        return view('frontend.pages.Store.detail', compact('page', 'stores', 'store'));
    }
}
