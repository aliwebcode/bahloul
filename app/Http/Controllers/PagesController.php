<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if(!$page) {
            $page = Page::findOrFail($slug);
            if(!$page)
                return 0;
        }
        return response()->json($page);
    }
}
