<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\City;
use App\Country;
use App\Job;
use App\Notifications\NewCandidateNotification;
use App\User;
use Illuminate\Http\Request;

class ApplicantsController extends Controller
{
    public function add(Request $request) {
        $data = [
            "job_id" => $request->job_id,
            "user_id" => auth()->id(),
            'notes' => $request->notes == 'null' ? '' : $request->notes,
        ];
        $applicant = Applicant::where('job_id', $data['job_id'])
            ->where('user_id', auth()->id())
            ->first();
        if(!$applicant) {
            $newApplicant = Applicant::create($data);
            // Send Notification
            $job = Job::find($request->job_id);
            $user = $job->user;
            $user->notify(new NewCandidateNotification($newApplicant));
            return response()->json(1,200);
        }
        return response()->json(1,200);
    }

    public function get_applied_jobs() {
        $data = User::with([
            'applicants.job.country', 'applicants.job.city', 'applicants.job.user',
            'applicants.job.category'
        ])->find(auth()->id());
        return response()->json($data);
    }

    public function delete(Request $request) {
        $applicant = Applicant::find($request->id);
        $applicant->delete();
        return response()->json(1,200);
    }

    public function get_applicants($id) {
        if(auth()->user()->type != 2) {
            return 0;
        }
        $data = Job::with([
            'applicants.user','applicants.user.country','applicants.user.city',
            'applicants.user.category'
        ])->find($id);
        return response()->json($data);
    }

}
