<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    private function validasiEvents(Request $request, $imageRule)
    {
        $rules = [
            'title' => 'required',
            'img.*' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'required',
            'category' => 'required',
            // 'sub_title' => 'required',
            'date_open' => 'required',
            'date_close' => 'required',
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

            $path = public_path('dist/assets/img/Events/' . $directory);
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
        $page = 'Event';
        $data = Event::latest()->get();
        return view('admin.pages.Event.index', compact('page', 'data'));
    }
    public function create()
    {
        $page = 'Event';
        return view('admin.pages.Event.create', compact('page'));
    }

    public function store(Request $request)
    {
        $this->validasiEvents($request, 'required');

        $images = $this->getImages($request->file('img'), $request->title);

        $data = [
            'title' => $request->title,
            // 'sub_title' => $request->sub_title,
            'img' => $images,
            'desc' => $request->desc,
            'category' => $request->category,
            'date_open' => $request->date_open,
            'date_close' => $request->date_close,
            'open' => $request->open,
            'close' => $request->close,
            'address' => $request->address,
            'phone' => $request->phone,
        ];

        $events = Event::create($data);

        if ($events) {
            return redirect()->route('event.show')->with('success', 'Berhasil Menambahkan Data Event');
        }
    }

    public function edit($id)
    {
        $page = 'Event';
        $edit = Event::findOrFail($id);
        return view('admin.pages.Event.edit', compact('page', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $this->validasiEvents($request, 'sometimes');

        if ($request->hasFile('img')) {
            $this->deleteImage('Events', $event->img);
            $images = $this->getImages($request->file('img'), $request->title);
        } else {
            $images = $event->img ?? '';
        }


        $event->update([
            'title' => $request->title,
            // 'sub_title' => $request->sub_title,
            'img' => $images,
            'desc' => $request->desc,
            'category' => $request->category,
            'date_open' => $request->date_open,
            'date_close' => $request->date_close,
            'open' => $request->open,
            'close' => $request->close,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('event.show')->with('success', 'Berhasil Mengubah Data Event');
    }

    public function destroy($id)
    {
        $events = Event::findOrFail($id);

        if ($events->img) {
            $this->deleteImage('Events', $events->img);
        }

        $events->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Event');
    }
}
