<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResumesController extends Controller
{

    public function get_resumes()
    {
//        $resumes = User::with(['country', 'city', 'category'])
//            ->where('status', 1)
//            ->where('type', 1)->get();
        $resumes = User::when(\request()->name != null, function ($q) {
            $q->where('name', 'like', '%' . \request()->name . '%');
        })->when(\request()->gender != null, function ($q) {
            $q->where('gender', \request()->gender);
        })->when(\request()->category_id != null, function ($q) {
            $q->where('category_id', \request()->category_id);
        })->when(\request()->country_id != null, function ($q) {
            $q->where('country_id', \request()->country_id);
        })->when(\request()->city_id != null, function ($q) {
            $q->where('city_id', \request()->city_id);
        })->when(\request()->date != null, function ($q) {
            $q->where('created_at', '>=', Carbon::now()->subDays(\request()->date));
        })->where('status', 1)->where('type', 1);

        $count = $resumes->count();
        $resumes = $resumes->with(['country', 'city', 'category'])
            ->latest()
            ->paginate(\request()->per_page ?? 5);


        if(\request()->name || \request()->gender || \request()->category_id || \request()->country_id
            || \request()->city_id || \request()->date) {
            return response()->json(["resumes" => $resumes, "count" => $count]);
        }

        $countries = Country::all();
        $categories = Category::all();

        return response()->json([
            "resumes" => $resumes,
            "categories" => $categories,
            "countries" => $countries,
            "count" => $count
        ]);

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
