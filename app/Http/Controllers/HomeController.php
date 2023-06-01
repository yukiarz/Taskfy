<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $con = DB::table('contributors')
        // ->where('project_id', 1)
        // ->pluck('user_id')
        // ->toArray();
        // return $con;
        $targets = $this->getTarget();
        $reminders = $this->getReminder();
        $projectThisWeeks = $this->getProjectThisWeek();
        $projectThisMonths = $this->getProjectThisMonth();

        return view('index',compact(
            'targets',
            'reminders',
            'projectThisWeeks',
            'projectThisMonths'
        ));
        
    }


    public function getTarget(){
        return Target::where('user_id',Auth::user()->id)
        ->orderBy('id','desc')->limit(5)->get();
    }

    public function getReminder(){
        $user = User::where('id',Auth::user()->id)->first();
        return $user->reminder()->limit(5)->get();
    }

    public function getProjectThisWeek(){
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $user = Auth::user();
        $projects = $user->project()
            ->where('created_at', $startDate)
            ->get();

        return $projects;
    }

    public function getProjectThisMonth(){
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $user = Auth::user();
        $projects = $user->project()
            ->where('start', $startDate)
            ->get();
        return $projects;
    }

    public function getUpcomingProject(){
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $user = Auth::user();
        $projects = $user->project()
            ->where('start', [$startDate, $endDate])
            ->get();
        return $projects;
    }

}
