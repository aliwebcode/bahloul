<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function get_businesses() {
//        $businesses = User::with([
//            'category', 'country', 'city'
//        ])->where('type', 3)->get();
//        $categories = Category::all();
//        return response()->json(["businesses" => $businesses, "categories" => $categories]);
        $businesses = User::when(\request()->title != null, function ($q) {
            $q->where('name', 'like', '%' . \request()->title . '%');
        })->when(\request()->category_id != null, function ($q) {
            $q->where('category_id', \request()->category_id);
        })->when(\request()->country_id != null, function ($q) {
            $q->where('country_id', \request()->country_id);
        })->when(\request()->city_id != null, function ($q) {
            $q->where('city_id', \request()->city_id);
        })->when(\request()->name != null, function ($q) {
            $q->where('name', 'like', '%' . \request()->name . '%');
        })->when(\request()->date != null, function ($q) {
            $q->where('created_at', '>=', Carbon::now()->subDays(\request()->date));
        })->where('type', 3);
        $count = $businesses->count();

        $businesses = $businesses->with(['country', 'city', 'category'])
            ->latest()
            ->paginate(\request()->per_page ?? 5);


        if(\request()->title || \request()->category_id || \request()->country_id
            || \request()->city_id || \request()->date) {
            return response()->json(["businesses" => $businesses, "count" => $count]);
        }

        $countries = Country::all();
        $categories = Category::all();

        return response()->json([
            "businesses" => $businesses,
            "categories" => $categories,
            "countries" => $countries,
            "count" => $count
        ]);

    }
    
    public function business_filter(Request $request) {
        // Global
        $title = $request->data['title'] ?? "";
        $location = $request->data['location'] ?? "";
        $category_id = $request->data['category_id'] ?? "";
        $date = $request->data['date'] ?? "";

        // Get Filtered Data
        $bus = User::query()->with(['country', 'city', 'category'])->where('type', 3);

        if($location && $bus->count() > 0) {
            $bus = $bus->where('type', 3)
                ->whereHas('country', function ($q) use ($location) {
                $q->where('name', 'like', '%' . $location . '%');
            })->orWhereHas('city', function ($q) use ($location) {
                $q->where('name', 'like', '%' . $location . '%');
            })->where('type', 3);
        }

        if($title) {
            $bus = $bus->where('name', 'like', '%' . $title . '%')
                ->orWhere('b_name', 'like', '%' . $title . '%');
        }
        if($category_id) {
            $bus = $bus->where('category_id', $category_id);
        }
        if($date) {
            $d = Carbon::now()->subDays($date);
            $bus = $bus->where('created_at', '>=', $d);
        }

        $results = $bus->get();

        return response()->json($results);
    }
    
}
