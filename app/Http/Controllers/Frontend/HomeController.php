<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Media;
use App\Models\Store;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Mail\SuggestionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    public function index()
    {
        $page = 'Home';
        // $events = Event::inRandomOrder()->limit(6)->get();
        // $stores = Store::with('rCategory')->inRandomOrder()->limit(6)->get();
        // $banners = Media::where('type', 'banner')->get();
        // $logos = Media::where('type', 'store')->get();
        $stores = Cache::remember('home_stores', 1800, function () {
            return Store::with('rCategory:id,category')
                ->select('id', 'title', 'img', 'address', 'category_id')
                ->inRandomOrder()
                ->limit(6)
                ->get();
        });

        $events = Cache::remember('home_events', 1800, function () {
            return Event::select('id', 'title', 'desc', 'img', 'date_open', 'category')
                ->inRandomOrder()
                ->limit(6)
                ->get();
        });

        $banners = Cache::remember('home_banners', 3600, function () {
            return Media::where('type', 'banner')->get();
        });

        $logos = Cache::remember('home_logos', 3600, function () {
            return Media::where('type', 'store')->get();
        });

        return view('frontend.pages.Home.index', compact('page', 'events', 'stores', 'banners', 'logos'));
    }

    public function storeSuggest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $suggestions = new Suggestion();
        $suggestions->name = $request->name;
        $suggestions->email = $request->email;
        $suggestions->subject = $request->subject;
        $suggestions->message = $request->message;
        $suggestions->save();

        Mail::to('sakuranomiyamaika32@gmail.com')->send(new SuggestionMail($suggestions));
        // Mail::to(config('mail.from.address'))->send(new SuggestionMail($suggestions));

        return redirect()->back()->with('success', 'Terima Kasih, Pesan Anda Sudah Terkirim');
    }
}
