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
        return redirect()->route('login');
    }
}
