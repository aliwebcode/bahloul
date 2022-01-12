<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function get_businesses() {
        $businesses = User::with([
            'category', 'country', 'city'
        ])->where('type', 3)->get();
        $categories = Category::all();
        return response()->json(["businesses" => $businesses, "categories" => $categories]);
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
