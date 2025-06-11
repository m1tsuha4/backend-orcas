<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    private function validasiStore(Request $request, $imageRule)
    {
        $rules = [
            'title' => 'required',
            'img.*' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'required',
            'publish_date' => 'required',
            'author' => 'required'
        ];

        $request->validate($rules);
    }

    private function getImages($images, $name, $directory = '')
    {
        if (!$images) {
            return null;
        }

        $filenames = [];

        $shortName = Str::slug(Str::limit($name, 10, ''), '_');

        foreach ($images as $image) {
            $extension = $image->getClientOriginalExtension();
            $timestamp = date('ymd_His');
            $random = Str::random(4);
            $filename = "{$shortName}_{$timestamp}_{$random}.{$extension}";

            $path = public_path('dist/assets/img/News/' . $directory);
            $image->move($path, $filename);

            $filenames[] = $filename;
        }

        return implode(',', $filenames); // Gabungkan jadi satu string
    }

    private function deleteImage($folder, $filename)
    {
        $images = explode(',', $filename);
        foreach ($images as $file) {
            $path = public_path("dist/assets/img/$folder/$file");
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    public function index() 
    {
        $page = 'News';
        $data = News::latest()->get();
        return view('admin.pages.News.index', compact('page', 'data'));
    }

    public function create() 
    {
        $page = 'News';
        return view('admin.pages.News.create', compact('page'));
    }

    public function store(Request $request) 
    {
        $this->validasiStore($request, 'required');

        $images = $this->getImages($request->file('img'), $request->title);

        $data = [
            'title' => $request->title,
            'img' => $images,
            'desc' => $request->desc,
            'publish_date' => $request->publish_date,
            'author' => $request->author,
        ];

        $news = News::create($data);

        if ($news) {
            return redirect()->route('news.show')->with('success', 'Berhasil Menambahkan Data News');
        }
    }

    public function edit($id) 
    {
        $page = 'News';
        $edit = News::findOrFail($id);
        return view('admin.pages.News.edit', compact('page', 'edit'));
    }

    public function update(Request $request, $id) 
    {
        $news = News::findOrFail($id);

        $this->validasiStore($request, 'sometimes');

        if ($request->hasFile('img')) {
            $this->deleteImage('News', $news->img);
            $images = $this->getImages($request->file('img'), $request->title);
        } else {
            $images = $news->img ?? '';
        }

        $news->update([
            'title' => $request->title,
            'img' => $images,
            'desc' => $request->desc,
            'publish_date' => $request->publish_date,
            'author' => $request->author,
        ]);

        return redirect()->route('news.show')->with('success', 'Berhasil Mengubah Data News');
    }

    public function destroy($id) 
    {
        $news = News::findOrFail($id);
        $this->deleteImage('News', $news->img);
        $news->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data News');
    }
}
