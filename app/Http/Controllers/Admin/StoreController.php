<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class StoreController extends Controller
{
    private function validasiStore(Request $request, $imageRule)
    {
        $rules = [
            'title' => 'required',
            'img.*' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'desc' => 'required',
            'type' => 'required',
            'open' => 'required',
            'close' => 'required',
            'address' => 'required',
            'phone' => 'required',
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

            $path = public_path('dist/assets/img/Stores/' . $directory);
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
        $page = 'Store';
        $data = Store::with('rCategory')->latest()->get();
        return view('admin.pages.Store.index', compact('page', 'data'));
    }
    public function create()
    {
        $page = 'Store';
        $categories = Category::all();
        return view('admin.pages.Store.create', compact('page', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validasiStore($request, 'required');

        $images = $this->getImages($request->file('img'), $request->title);

        $data = [
            'title' => $request->title,
            'img' => $images,
            // 'desc' => $request->desc,
            'category_id' => $request->type,
            'open' => $request->open,
            'close' => $request->close,
            'address' => $request->address,
            'phone' => $request->phone,
        ];

        $stores = Store::create($data);

        if ($stores) {
            return redirect()->route('store.show')->with('success', 'Berhasil Menambahkan Data Store');
        }
    }

    public function edit($id)
    {
        $page = 'Store';
        $categories = Category::all();
        $edit = Store::with('rCategory')->findOrFail($id);
        return view('admin.pages.Store.edit', compact('page', 'categories', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $this->validasiStore($request, 'sometimes');

        if ($request->hasFile('img')) {
            $this->deleteImage('Stores', $store->img);
            $images = $this->getImages($request->file('img'), $request->title);
        } else {
            $images = $store->img ?? '';
        }


        $store->update([
            'title' => $request->title,
            'img' => $images,
            // 'desc' => $request->desc,
            'category_id' => $request->type,
            'open' => $request->open,
            'close' => $request->close,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('store.show')->with('success', 'Berhasil Mengubah Data Store');
    }

    public function destroy($id)
    {
        $stores = Store::findOrFail($id);

        if ($stores->img) {
            $this->deleteImage('Stores', $stores->img);
        }

        $stores->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Store');
    }
}
