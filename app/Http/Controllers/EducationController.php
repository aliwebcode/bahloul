<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function add(Request $request) {
        $data = $request->edu;
        $data['user_id'] = auth()->id();
        $edu = Education::create($data);
        return response()->json($edu,200);
    }

    public function update(Request $request) {
        $data = $request->edu;
        $edu = Education::find($data['id']);
        $edu->college = $data['college'];
        $edu->certificate = $data['certificate'];
        $edu->field = $data['field'];
        $edu->start_year = $data['start_year'];
        $edu->end_year = $data['end_year'];
        $edu->description = $data['description'];
        $edu->save();
        return response()->json(1,200);
    }

    public function delete(Request $request) {
        $edu = Education::find($request->id);
        $edu->delete();
        return response()->json(1,200);
    }
}
