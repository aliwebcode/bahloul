<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Auth::routes();

Route::get('/in', function () {
    phpinfo();
});

// Handle All Requests
Route::group(['prefix' => 'request', 'as' => 'request.'], function () {

    Route::post('/near', function (Request $request) {

        $cities = \App\City::where('city', '!=', null)
            ->when($request->long and $request->lat, function ($q) use ($request) {
                $q->addSelect(\Illuminate\Support\Facades\DB::raw(
                    "*, (((acos(sin(( '$request->lat' *pi()/180)) * sin((`lat`*pi()/180)) + cos(( '$request->lat' *pi()/180)) * cos((`lat`*pi()/180))* cos((('$request->long' - `lng`) * pi()/180)))) * 180/pi()) * 60 * 1.1515 * 1.609344) as distance")
                );
//            ->when($request->long and $request->lat, function ($q) use ($request) {
//                $q->addSelect(\Illuminate\Support\Facades\DB::raw("
//                lat_lng_distance('$request->lat', '$request->long', 'lat', 'lng')
//                "));
            })
            ->orderBy('distance', 'asc')
            ->get();
        return response()->json($cities);
    });

    // Get City
    Route::get('/get-city/{id}',function ($id) {
        return response()->json(\App\City::where('country_id', $id)->get());
    });
    // Get cities
    Route::get('/get-cities', function () {
        return \App\City::get(['id', 'city']);
    });
    Route::get('/get-all-categories', function () {
        return response()->json(\App\Category::all());
    });

    Route::get('/get-settings', function () {
        return \App\Setting::first();
    });

    // Profile Requests
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        /* Dashboard */
        Route::get('/get-user-dashboard', 'ProfileController@dashboard');
        Route::get('/get-user-profile', 'ProfileController@index');
        Route::post('/update-profile','ProfileController@update');
        Route::get('/get-resume','ProfileController@get_resume');
        Route::get('/get-all-categories','ProfileController@get_all_categories');
        /* Change Email */
        Route::post('/change-email','ProfileController@change_email');
        /* Change Password */
        Route::post('/change-password','ProfileController@change_password');
        /* Education Requests */
        Route::post('/add-education','EducationController@add');
        Route::post('/update-education','EducationController@update');
        Route::post('/delete-education','EducationController@delete');
        /* Experience Requests */
        Route::post('/add-experience','ExperienceController@add');
        Route::post('/update-experience','ExperienceController@update');
        Route::post('/delete-experience','ExperienceController@delete');
        /* Portfolio Requests */
        Route::get('/get-portfolio','PortfolioController@get');
        Route::post('/add-portfolio','PortfolioController@add');
        Route::post('/delete-portfolio','PortfolioController@delete');
        /* Jobs Requests */
        Route::get('/get-user-jobs','JobsController@get_user_jobs');
        Route::get('/get-add-job','JobsController@get_add_job');
        Route::get('/get-edit-job/{id}','JobsController@get_edit_job');
        Route::get('/get-cities/{id}','JobsController@get_cities');
        Route::post('/add-job','JobsController@add');
        Route::post('/update-job','JobsController@update');
        /* Applicants Requests */
        Route::get('/get-applied-jobs', 'ApplicantsController@get_applied_jobs');
        Route::post('/delete-applicant','ApplicantsController@delete');
        Route::get('/get-applicants/{id}','ApplicantsController@get_applicants');
        /* Cv Requests */
        Route::post('/update-cv','ProfileController@update_cv');
        Route::post('/delete-cv','ProfileController@delete_cv');
        /* Shortlists Requests */
        Route::get('/get-shortlists','ShortlistsController@index');
        Route::post('/save-shortlist','ShortlistsController@save');
        Route::post('/delete-shortlist','ShortlistsController@delete');
        /* Notifications Requests */
        Route::get('/mark-notifications-as-read', function () {
            $notifications = auth()->user()->unreadNotifications;
            foreach ($notifications as $notification) {
                $notification->markAsRead();
            }
            return response()->json(1,200);
        });
    });

    // Front Requests
    Route::group(['prefix' => 'front', 'as' => 'front.'], function () {
        /* Show Profile */
        Route::get('get-user-profile/{username}','ProfileController@get_user_profile');
        /* Show Job */
        Route::get('/get-job/{id}','JobsController@show');
        /* Apply For Jobs Action */
        Route::post('/apply-for-job','ApplicantsController@add');
        /* Jobs Page */
        Route::get('/get-jobs','JobsController@get_jobs');
        /* Filter Jobs */
        Route::post('/job-filter','JobsController@job_filter');
        /* Resumes Page */
        Route::get('/get-resumes','ResumesController@get_resumes');
        /* Filter Resumes */
        Route::post('/resume-filter','ResumesController@resume_filter');
        /* Businesses Page */
        Route::get('/get-businesses','BusinessController@get_businesses');
        /* Filter Businesses */
        Route::post('/business-filter','BusinessController@business_filter');

        /* Home Request */
        Route::group(['prefix' => 'home'], function() {
            /* Get Cities */
            Route::get('/get-cities/{c}','HomeController@get_cities');
            /* Get FAQ */
            Route::get('/get-faq','HomeController@get_faq');
            /* Get Services */
            Route::get('/get-services','HomeController@get_services');
        });


    });

    // Auth Requests
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/check-username/{username}', 'HomeController@check_username');
        Route::post('/login', 'Auth\LoginController@login_action');
        Route::post('/register', 'Auth\RegisterController@register_action');
    });

});
Route::get('/ar/logout', function () {
    auth()->logout();
    return redirect("/ar/login");
});
Route::get('/en/logout', function () {
    auth()->logout();
    return redirect("/en/login");
});
Route::get('/logout', function () {
    auth()->logout();
    return redirect("/login");
});
Route::get('/{any?}', 'HomeController@index')->where('any', '^(?!admin).*$');
