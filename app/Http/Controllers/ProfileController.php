<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Country;
use App\Job;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if(!Auth::check())
            return 0;
        $user = User::with(['country', 'city'])->find(auth()->id());
        return response()->json([
            "user" => $user,
            "categories" => Category::all(),
            "countries" => Country::all(),
            "cities" => City::all()
        ]);
    }

    public function dashboard()
    {
        if(!Auth::check()) {
            return 0;
        }
        if (auth()->user()->type == 1) {
            $user = User::with([
                'applicants.job.user', 'applicants.job.category',
                'applicants.job.country', 'applicants.job.city', 'user_portfolio',
                'shortlists', 'user_education', 'user_experience'
            ])
                ->find(auth()->id());
            $suggestedJobs = Job::with([
                'user', 'country', 'city', 'category'
            ])
                ->where('category_id', $user->category_id)
                ->where(function($query) {
                    $query->where('expire_date',null)
                        ->orWhere('expire_date', '>', Date("Y-m-d"));
                })
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
            return response()->json(["user" => $user, "suggestedJobs" => $suggestedJobs]);
        } else if (auth()->user()->type == 2) {
            $user = User::with('jobs', 'shortlists')->find(auth()->id());
            return response()->json(["user" => $user]);

        } else if(auth()->user()->type == 3) {
            $user = User::with([
                'user_portfolio', 'shortlists'
            ])->find(auth()->id());
            return response()->json(["user" => $user]);

        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request['name'] == 'null' ? '' : $request['name'],
            'job_title' => $request['job_title'] == 'null' ? '' : $request['job_title'],
            'phone' => $request['phone'] == 'null' ? '' : $request['phone'],
            'category_id' => $request['category_id'] == 'null' ? null : $request['category_id'],
            'website' => $request['website'] == 'null' ? '' : $request['website'],
            'birthday' => $request['birthday'] == 'null' ? '' : $request['birthday'],
            'experience' => $request['experience'] == 'null' ? '' : $request['experience'],
            'status' => $request['status'] == 'null' ? '' : $request['status'],
            'description' => $request['description'] == 'null' ? '' : $request['description'],
            'facebook' => $request['facebook'] == 'null' ? '' : $request['facebook'],
            'twitter' => $request['twitter'] == 'null' ? '' : $request['twitter'],
            'linkedin' => $request['linkedin'] == 'null' ? '' : $request['linkedin'],
            'instagram' => $request['instagram'] == 'null' ? '' : $request['instagram'],
            'country_id' => $request['country_id'] == 'null' ? null : $request['country_id'],
            'city_id' => $request['city_id'] == 'null' ? null : $request['city_id'],
            'address' => $request['address'] == 'null' ? '' : $request['address'],
            'skills' => $request['skills'] == 'null' ? '' : $request['skills'],
            'languages' => $request['languages'] == 'null' ? '' : $request['languages'],
            'education' => $request['education'] == 'null' ? '' : $request['education'],
            'company_email' => $request['company_email'] == 'null' ? '' : $request['company_email'],
            'founded_in' => $request['founded_in'] == 'null' ? null : $request['founded_in'],
            'company_size' => $request['company_size'] == 'null' ? '' : $request['company_size'],
            'b_name' => $request['b_name'] == 'null' ? '' : $request['b_name'],
            'b_email' => $request['b_email'] == 'null' ? '' : $request['b_email'],
        ]);
        if ($request->hasFile('image')) {
            if (File::exists('images/users/' . $user->image)) {
                File::delete('images/users/' . $user->image);
            }
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/users/', $newName);
            $user->image = $newName;
            $user->save();
        }
        return response()->json(1, 200);
    }

    public function get_resume()
    {
        $user = auth()->user();
        $edu = $user->user_education;
        $exp = $user->user_experience;
        return response()->json(["user" => $user, "edu" => $edu, "exp" => $exp]);
    }

    public function update_cv(Request $request) {
        $user = auth()->user();
        if ($request->hasFile('cv')) {
            if (File::exists('cv/' . $user->cv)) {
                File::delete('cv/' . $user->cv);
            }
            $cv = $request->file('cv');
            $filename = $cv->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $cv->move('cv/', $newName);
            $user->cv = $newName;
            $user->save();
        }
        return response()->json(1,200);
    }

    public function delete_cv(Request $request) {
        $user = auth()->user();
        if (File::exists('cv/' . $user->cv)) {
            File::delete('cv/' . $user->cv);
        }
        $user->cv = null;
        $user->save();
        return response()->json(1,200);
    }

    public function get_user_profile($username)
    {
        // Get user by username
        $user = User::with([
            'country', 'city', 'user_education', 'user_experience', 'user_portfolio.portfolio_images', 'category',
            'jobs.user', 'jobs.country', 'jobs.city', 'jobs.category'
        ])
            ->where('username', $username)->first();
        // Check if user exists
        if (!$user) return 0;
        return response()->json($user);
    }

    public function change_email(Request $request)
    {
        return User::find(auth()->id())->update([
            'email' => $request->email
        ]);
    }

    public function change_password(Request $request)
    {
        if(Hash::check($request->oldPassword, auth()->user()->password)) {
            return User::find(auth()->id())->update([
                'password' => Hash::make($request->newPassword)
            ]);
        } else {
            return 0;
        }
    }
}
