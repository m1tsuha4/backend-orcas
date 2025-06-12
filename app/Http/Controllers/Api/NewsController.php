<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResources;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function home()
    {
        try {
            $news = News::latest()->limit(4)->get();

            $news->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/News/' . trim($item->img));
                return $item;
            });
            return new NewsResources(true, 'News data fetched successfully', $news);
        } catch (\Exception $e) {
            return new NewsResources(false, 'Failed to fetch news data', null);
        }
    }

    public function index()
    {
        try {
            $news = News::latest()->get();

            $news->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/News/' . trim($item->img));
                return $item;
            });
            return new NewsResources(true, 'News data fetched successfully', $news);
        } catch (\Exception $e) {
            return new NewsResources(false, 'Failed to fetch news data', null);
        }
    }

    public function show($id)
    {
        try {
            $news = News::findOrFail($id);
            $news->img_url = asset('dist/assets/img/News/' . trim($news->img));
            return new NewsResources(true, 'News data fetched successfully', $news);
        } catch (\Exception $e) {
            return new NewsResources(false, 'Failed to fetch news data', null);
        }
    }

    public function search(Request $request)
    {
        try {
            $news = News::where('title', 'LIKE', '%' . $request->title . '%')->get();
            $news->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/News/' . trim($item->img));
                return $item;
            });
            return new NewsResources(true, 'News data fetched successfully', $news);
        } catch (\Exception $e) {
            return new NewsResources(false, 'Failed to fetch news data', null);
        }
    }

    public function another($id)
    {
        try {
            $news = News::where('id', '!=', $id)->limit(4)->get();
            $news->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/News/' . trim($item->img));
                return $item;
            });
            return new NewsResources(true, 'News data fetched successfully', $news);
        } catch (\Exception $e) {
            return new NewsResources(false, 'Failed to fetch news data', null);
        }
    }
}
