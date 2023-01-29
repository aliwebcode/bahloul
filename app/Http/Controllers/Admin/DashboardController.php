<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $candidates_count = User::where('type', 1)->count();
        $companies_count = User::where('type', 2)->count();
        $business_count = User::where('type', 3)->count();
        $jobs_count = Job::count();
        $users = User::latest()->take(5)->get();
        return view('admin.index', compact('candidates_count', 'companies_count', 'business_count', 'jobs_count', 'users'));
    }
}
