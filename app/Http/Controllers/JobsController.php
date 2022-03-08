<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Country;
use App\Job;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function get_user_jobs()
    {
        if(auth()->user()->type != 2)
            return 0;
        $data = User::with(['jobs', 'jobs.category', 'jobs.applicants', 'jobs.country', 'jobs.city'])->find(auth()->id());
        return response()->json($data);
    }

    public function get_add_job()
    {
        $user = auth()->user();
        if($user->type != 2) {
            return 0;
        }
        $countries = Country::all();
        $cities = City::all();
        $categories = Category::all();
        return response()->json([
            "user" => $user,
            "countries" => $countries,
            "cities" => $cities,
            "categories" => $categories
        ]);
    }

    public function get_edit_job($id)
    {
        $user = auth()->user();
        if($user->type != 2) {
            return 0;
        }
        $countries = Country::all();
        $cities = City::all();
        $categories = Category::all();
        $job = Job::find($id);
        return response()->json([
            "user" => $user,
            "countries" => $countries,
            "cities" => $cities,
            "categories" => $categories,
            "job" => $job
        ]);
    }

    public function get_cities($id)
    {
        $cities = City::where('country_id', $id)->get();
        return response()->json($cities);
    }

    public function add(Request $request)
    {
        $data = $request->job;
        $data['user_id'] = auth()->id();
        Job::create($data);
        return response()->json(1, 200);
    }

    public function update(Request $request)
    {
        $job = Job::find($request->job['id']);

        $job->update([
            'user_id' => auth()->id(),
            'title' => $request->job['title'],
            'description' => $request->job['description'],
            'category_id' => $request->job['category_id'],
            'country_id' => $request->job['country_id'] == 'null' ? null : $request->job['country_id'],
            'city_id' => $request->job['city_id'] == 'null' ? null : $request->job['city_id'],
            'type' => $request->job['type'],
            'hours' => $request->job['hours'] == 'null' ? null : $request->job['hours'],
            'salary' => $request->job['salary'] == 'null' ? null : $request->job['salary'],
            'skills' => $request->job['skills'],
            'gender' => $request->job['gender'] == 'null' ? null : $request->job['gender'],
            'show_applicants_num' => $request->job['show_applicants_num'],
            'expire_date' => $request->job['expire_date'] == 'null' ? null : $request->job['expire_date'],
        ]);

        return response()->json(1,200);
    }

    public function show($id)
    {
        $job = Job::with([
            'category', 'country', 'city', 'user', 'user.country', 'user.city', 'applicants'
        ])->find($id);
        if(!$job) return 0;
        if(auth()->check())
            $user = User::with(['country', 'city'])->find(auth()->id());
        else
            $user = "";
        $related = Job::where('category_id',$job->category_id)
            ->where('id', '!=', $id)
            ->with(['country', 'city', 'user'])
            ->get();
        return response()->json(["job" => $job, "user" => $user, "related" => $related]);
    }

    public function get_jobs()
    {
        $jobs = Job::when(\request()->title != null, function ($q) {
                $q->where('title', 'like', '%' . \request()->title . '%');
            })
            ->when(\request()->type != null, function ($q) {
                $q->where('type', \request()->type);
            })
            ->when(\request()->country_id != null, function ($q) {
                $q->where('country_id', \request()->country_id);
            })
            ->when(\request()->city_id != null, function ($q) {
                $q->where('city_id', \request()->city_id);
            })
            ->when(\request()->category_id != null, function ($q) {
                $q->where('category_id', \request()->category_id);
            })
            ->when(\request()->date != null, function ($q) {
                $q->where('created_at', '>=', Carbon::now()->subDays(\request()->date));
            });
        $count = $jobs->count();
        $jobs = $jobs->with(['user', 'country', 'city', 'category', 'applicants'])
            ->latest()
            ->paginate(\request()->per_page ?? 5);

        if(\request()->title || \request()->type || \request()->country_id || \request()->city_id
            || \request()->category_id || \request()->date) {
            return response()->json(["jobs" => $jobs, "count" => $count]);
        }

        $countries = Country::all();
        $categories = Category::all();

        return response()->json([
            "jobs" => $jobs,
            "categories" => $categories,
            "countries" => $countries,
            "count" => $count
        ]);
    }

    public function job_filter(Request $request)
    {
        // Global
        $title = $request->data['title'] ?? "";
        $type = $request->data['type'] ?? "";
        $location = $request->data['location'] ?? "";
        $category_id = $request->data['category_id'] ?? "";
        $date = $request->data['date'] ?? "";

        // Get Filtered Data
        $jobs = Job::query()->with(['user', 'country', 'city', 'category', 'applicants']);
        if($location && $jobs->count() > 0) {
            $jobs = $jobs->whereHas('country', function ($q) use ($location) {
                $q->where('name', 'like', '%' . $location . '%');
            })->orWhereHas('city', function ($q) use ($location) {
                $q->where('name', 'like', '%' . $location . '%');
            });
        }
        if($title) {
            $jobs = $jobs->where('title', 'like', '%' . $title . '%')
            ->orWhereHas('user', function ($q) use ($title) {
                $q->where('name', 'like', '%' . $title . '%');
            });
        }
        if($type) {
            $jobs = $jobs->where('type', $type);
        }
        if($category_id) {
            $jobs = $jobs->where('category_id', $category_id);
        }
        if($date) {
            $d = Carbon::now()->subDays($date);
            $jobs = $jobs->where('created_at', '>=', $d);
        }
        $results = $jobs->get();
        return response()->json($results);
    }

}
