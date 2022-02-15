<?php

namespace App\Http\Controllers;

use App\Shortlist;
use Illuminate\Http\Request;

class ShortlistsController extends Controller
{
    public function index() {
        $sh = Shortlist::with([
            'user',
            'resume.country', 'resume.city', 'resume.category',
            'company.country', 'company.city', 'company.category',
            'business.country', 'business.city', 'business.category',
            'job.country', 'job.city', 'job.category', 'job.user',
        ])
            ->where('user_id',auth()->id())
            ->latest()
            ->get();
        return response()->json($sh);
    }
    public function save(Request $request) {
        if(!auth()->check()) return 0;
        $data = [
            "target_id" => $request->target_id,
            "user_id" => auth()->id(),
            "type" => $request->type
        ];
        $shortlist = Shortlist::updateOrCreate($data);
        return 1;
    }
    public function delete(Request $request) {
        $s = Shortlist::find($request->id);
        $s->delete();
        return response()->json(1,200);
    }
}
