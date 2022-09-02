<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{
    public function index($type)
    {
        $users = User::with(['country', 'city']);
        if (\request()->word) {
            $users = $users->where('name', 'like', '%' . \request()->word . '%');
        }
        if ($type == "resume") {
            $users = $users->where('type', 1)
                ->latest()
                ->paginate(10);
            return view('admin.users.index')->with([
                'users' => $users,
                'type' => 'resume'
            ]);
        } else if ($type == "company") {
            $users = $users->where('type', 2)
                ->latest()
                ->paginate(10);
            return view('admin.users.index')->with([
                'users' => $users,
                'type' => 'company'
            ]);
        } else if ($type == "business") {
            $users = $users->where('type', 3)
                ->latest()
                ->paginate(10);
            return view('admin.users.index')->with([
                'users' => $users,
                'type' => 'business'
            ]);
        } else {
            return redirect()->route('admin.users', 'resume');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $type = null;
        if($user->type == 1)
            $type = "resume";
        else if($user->type == 2)
            $type = "company";
        else
            $type = "business";
        return view('admin.users.show')->with([
            'user' => $user,
            'type' => $type
        ]);
    }

    public function block(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->blocked = 1;
        $user->save();
        return redirect()->back()->with('msg', 'تم حظر المستخدم بنجاح');
    }

    public function unblock(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->blocked = 0;
        $user->save();
        return redirect()->back()->with('msg', 'تم فك  الحظر عن المستخدم بنجاح');
    }

    public function delete(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        if(File::exists('images/users/' . $user->image)) {
            File::delete('images/users/' . $user->image);
        }
        if(File::exists('images/covers/' . $user->cover)) {
            File::delete('images/covers/' . $user->cover);
        }
        if(File::exists('cv/' . $user->cv)) {
            File::delete('cv/' . $user->cv);
        }
        $portfolio = $user->user_portfolio;
        foreach ($portfolio as $port) {
            foreach ($port->portfolio_images as $img) {
                if(File::exists('images/portfolio/' . $img->image)) {
                    File::delete('images/portfolio/' . $img->image);
                }
            }
        }
        $user->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
