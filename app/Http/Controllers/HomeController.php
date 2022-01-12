<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.index');
    }

    public function check_username($username) {
        return User::where('username', $username)->first() ? 1 : 0;
    }

    public function get_cities($c) {
        $city = City::where('name', 'like', '%' . $c. '%')->get();
        return response()->json($city);
    }
}
