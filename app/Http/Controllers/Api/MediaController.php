<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResources;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        try {
            $media = Media::select('id', 'img')->get();

            // Add full image URL
            $media->transform(function ($item) {
                $item->img_url = asset('dist/assets/img/Medias/' . trim($item->img));
                return $item;
            });
            return new MediaResources(true, 'Media data fetched successfully', $media);
        } catch (\Exception $e) {
            return new MediaResources(false, 'Failed to fetch media data', null);
        }
    }
}
