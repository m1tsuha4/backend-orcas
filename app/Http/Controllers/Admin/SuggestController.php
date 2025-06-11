<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestController extends Controller
{
    public function index()
    {
        $page = 'Suggestion';
        $data = Suggestion::latest()->get();
        return view('admin.pages.Suggest.index', compact('page', 'data'));
    }
}
