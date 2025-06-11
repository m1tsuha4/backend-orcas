<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Media;
use App\Models\Store;
use App\Models\Suggestion;

class DashboardController extends Controller
{
    public function index()
    {
        $page = "Dashboard";
        $mediaTotal = Media::count();
        $storeTotal = Store::count();
        $eventTotal = Event::count();
        $suggestTotal = Suggestion::count();
        return view('admin.pages.dashboard', compact('page', 'mediaTotal', 'storeTotal', 'eventTotal', 'suggestTotal'));
    }
}
