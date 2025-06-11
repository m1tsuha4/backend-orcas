<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    private function validasiBanner(Request $request, $imageRule)
    {
        $request->validate(
            [
                'img' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
    }

    private function getImage($image, $name, $directory = '')
    {
        if ($image == null) {
            return null;
        }
        $extension = $image->getClientOriginalExtension();

        $timestamp = date('Ymd_His');
        $filename = preg_replace('/\s+/', '_', $name) . '_' . $timestamp . '.' . $extension;

        $path = public_path('dist/assets/img/Medias/' . $directory);
        $image->move($path, $filename);
        return $filename;
    }

    private function deleteImage($folder, $filename)
    {
        $path = public_path("dist/assets/img/$folder/$filename");
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function index()
    {
        $page = 'Media';
        $banners = Media::get();
        return view('admin.pages.Media.index', compact('page', 'banners'));
    }

    public function store(Request $request)
    {
        $this->validasiBanner($request, 'required');
        $image = $this->getImage($request->file('img'), $request->title);
        $data = [
            'img' => $image,
        ];
        $banner = Media::create($data);
        if ($banner) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Gambar Banner');
        }
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $this->validasiBanner($request, 'sometimes');

        if ($request->hasFile('img')) {
            $this->deleteImage('Medias', $media->img);
            $image = $this->getImage($request->file('img'), $request->title);
        } else {
            $image = $media->img;
        }

        $media->update([
            'img' => $image,
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Gambar Banner');
    }

    public function destroy($id)
    {
        $banner = Media::findOrFail($id);

        if ($banner->img) {
            $this->deleteImage('Medias', $banner->img);
        }
        $banner->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Gambar Banner');
    }
}
