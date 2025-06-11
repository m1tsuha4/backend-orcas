<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Media;
use App\Models\News;
use App\Models\Product;
use App\Models\Store;
use App\Models\Suggestion;

class DashboardController extends Controller
{
    public function index()
    {
        $page = "Dashboard";
        $mediaTotal = Media::count();
        $categoryTotal = Category::count();
        $productTotal = Product::count();
        $newsTotal = News::count();
        return view('admin.pages.dashboard', compact('page', 'mediaTotal', 'categoryTotal', 'productTotal', 'newsTotal'));
    }
}
