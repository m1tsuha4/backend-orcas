<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
     private function validasiStore(Request $request, $imageRule)
    {
        $rules = [
            'title' => 'required',
            'img.*' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'required',
            'link' => 'required',
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

            $path = public_path('dist/assets/img/Product/' . $directory);
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
        $page = 'Product';
        $data = Product::with('Category')->latest()->get();
        return view('admin.pages.Product.index', compact('page', 'data'));
    }

    public function create()
    {
        $page = 'Product';
        $categories = Category::all();
        return view('admin.pages.Product.create', compact('page', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validasiStore($request, 'required');

        $images = $this->getImages($request->file('img'), $request->title);

        $data = [
            'title' => $request->title,
            'img' => $images,
            'desc' => $request->desc,
            'link' => $request->link,
            'category_id' => $request->type,
        ];

        $product = Product::create($data);

        if ($product) {
            return redirect()->route('product.show')->with('success', 'Berhasil Menambahkan Data Product');
        }
    }

    public function edit($id)
    {
        $page = 'Product';
        $categories = Category::all();
        $edit = Product::with('Category')->findOrFail($id);
        return view('admin.pages.Product.edit', compact('page', 'categories', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->validasiStore($request, 'sometimes');

        if ($request->hasFile('img')) {
            $this->deleteImage('Product', $product->img);
            $images = $this->getImages($request->file('img'), $request->title);
        } else {
            $images = $product->img ?? '';
        }

        $product->update([
            'title' => $request->title,
            'img' => $images,
            'desc' => $request->desc,
            'link' => $request->link,
            'category_id' => $request->type,
        ]);

        return redirect()->route('product.show')->with('success', 'Berhasil Mengubah Data Product');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage('Product', $product->img);
        $product->delete();
        return redirect()->route('product.show')->with('success', 'Berhasil Menghapus Data Product');
    }
}
