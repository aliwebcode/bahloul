<?php

namespace App\Http\Controllers;

use App\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function add(Request $request) {
        $data = $request->exp;
        $data['user_id'] = auth()->id();
        $exp = Experience::create($data);
        return response()->json($exp,200);
    }

    public function update(Request $request) {
        $data = $request->exp;
        $exp = Experience::find($data['id']);
        $exp->job_title = $data['job_title'];
        $exp->company = $data['company'];
        $exp->start_year = $data['start_year'];
        $exp->end_year = $data['end_year'];
        $exp->description = $data['description'];
        $exp->save();
        return response()->json(1,200);
    }

    public function delete(Request $request) {
        $exp = Experience::find($request->id);
        $exp->delete();
        return response()->json(1,200);
    }

}
