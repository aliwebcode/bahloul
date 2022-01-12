<?php

namespace App\Http\Controllers;

use App\Portfolio;
use App\PortfolioImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{

    public function get() {
        $user = User::with(['user_portfolio.portfolio_images'])->find(auth()->id());
        return response()->json($user);
    }

    public function add(Request $request) {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $data = [];
            $portfolio = Portfolio::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'url' => $request->url == 'null' ? '' : $request->url
            ]);
            foreach ($files as $file) {
                // title - desc - url - images
                $filename = $file->getClientOriginalName();
                $newName = uniqid() . '-' . now()->timestamp . $filename;
                $file->move('images/portfolio/', $newName);
                // Save Records
                $row = new PortfolioImage();
                $row->portfolio_id = $portfolio->id;
                $row->image = $newName;
                $row->save();
            }
            return response()->json($data);
        }
    }

    public function delete(Request $request) {
        $port = Portfolio::find($request->id);
        foreach ($port->portfolio_images as $p) {
            if(File::exists('images/portfolio/' . $p->image)) {
                File::delete('images/portfolio/' . $p->image);
            }
            $p->delete();
        }
        $port->delete();
        return response()->json(1,200);
    }
}
