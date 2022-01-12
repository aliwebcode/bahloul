<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResumesController extends Controller
{

    public function get_resumes()
    {
        $resumes = User::with(['country', 'city', 'category'])
            ->where('status', 1)
            ->where('type', 1)->get();
        $categories = Category::all();
        return response()->json(["resumes" => $resumes, "categories" => $categories]);
    }

    public function resume_filter(Request $request)
    {
        // Global
        $name = $request->data['name'] ?? "";
        $gender = $request->data['gender'] ?? "";
        $category_id = $request->data['category_id'] ?? "";
        $date = $request->data['date'] ?? "";
        $location = $request->data['location'] ?? "";

        // Get Filtered Data
        $resumes = User::with(['country', 'city', 'category'])->where('type', '=', 1);

        if ($name) {
            $resumes = $resumes->where('name', 'like', '%' . $name . '%');
        }
        if ($gender) {
            $resumes = $resumes->where('gender', $gender);
        }
        if ($category_id) {
            $resumes = $resumes->where('category_id', $category_id);
        }
        if ($date) {
            $d = Carbon::now()->subDays($date);
            $resumes = $resumes->where('created_at', '>=', $d);
        }
        if ($location && $resumes->count() > 0) {
            $resumes = $resumes->where('type', '=', 1)
                ->whereHas('country', function ($q) use ($location) {
                    $q->where('name', 'like', '%' . $location . '%');
                })->orWhereHas('city', function ($q) use ($location) {
                    $q->where('name', 'like', '%' . $location . '%');
                })->where('type', '=', 1);
        }

        $results = $resumes->get();
        return response()->json($results);
    }

}
