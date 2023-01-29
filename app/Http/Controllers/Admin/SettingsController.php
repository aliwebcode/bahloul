<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index() {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }
    public function update(Request $request) {
        $data = $request->except('_token');
        $settings = Setting::first();
        if ($request->hasFile('logo')) {
            if ($settings && File::exists('images/logo/' . $settings->logo))
                File::delete('images/logo/' . $settings->logo);
            $image = $request->file('logo');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/logo/', $newName);
            $data['logo'] = $newName;
        }
        if ($request->hasFile('about_image')) {
            if ($settings && File::exists('images/' . $settings->about_image))
                File::delete('images/' . $settings->about_image);
            $image = $request->file('about_image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/', $newName);
            $data['about_image'] = $newName;
        }
        if($settings)
            $settings->update($data);
        else
            $settings = Setting::create($data);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
}
