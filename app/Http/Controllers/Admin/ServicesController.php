<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        $pages = Page::latest()->get();
        return view('admin.services.index', compact('services', 'pages'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'page_id' => 'required'
        ]);
        Service::create([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'page_id' => $request->page_id
        ]);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $pages = Page::latest()->get();
        return view('admin.services.edit', compact('service', 'pages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'page_id' => 'required'
        ]);
        Service::findOrFail($request->service_id)->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'page_id' => $request->page_id
        ]);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }

    public function delete(Request $request) {
        $service = Service::findOrFail($request->id);
        $service->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
