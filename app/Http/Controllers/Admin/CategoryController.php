<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private function validasiCategory(Request $request)
    {
        $request->validate(
            [
                'category' => 'required',
            ]
        );
    }

    public function index()
    {
        $page = 'Category';
        $categories = Category::latest()->get();
        return view('admin.pages.Category.index', compact('page', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validasiCategory($request);
        $data = [
            'category' => request('category')
        ];
        $category = Category::create($data);
        if ($category) {
            return redirect()->back()->with('success', 'Berhasil Menambah Kategori');
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->validasiCategory($request);

        $category->update([
            'category' => $request->category,
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Kategori');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Kategori');
    }
}
