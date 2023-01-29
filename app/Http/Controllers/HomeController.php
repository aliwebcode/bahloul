<?php

namespace App\Http\Controllers;

use App\City;
use App\Faq;
use App\Service;
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

    public function get_faq() {
        $faq = Faq::latest()->get();
        return response()->json($faq, 200);
    }

    public function check_username($username) {
        return User::where('username', $username)->first() ? 1 : 0;
    }

    public function get_cities($c) {
        $city = City::where('city', 'like', '%' . $c. '%')
            ->get();
        return response()->json($city);
    }

    public function get_services() {
        $services = Service::latest()->get();
        return response()->json($services);
    }
}
