<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'body' => 'required',
            'body_ar' => 'required',
            'body_en' => 'required',
            'slug' => 'required|unique:pages,slug',
        ]);
        $data['slug'] = Str::slug($request->slug, '-');
        Page::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة  بنجاح');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request)
    {
        $page = Page::findOrFail($request->page_id);
        $page->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'body' => $request->body,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
        ]);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }

    public function delete(Request $request)
    {
        $page = Page::findOrFail($request->page_id);
        $page->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
