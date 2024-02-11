<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use App\Models\PureDate;
use App\Http\Requests\AttendanceRequest;
use App\Http\Controllers\RegisteredUserController;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;



use Illuminate\Support\Facades\Config;

class AttendanceController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $attendances = Attendance::where('user_id', $user->id)->latest()->first();

    if($attendances === null) {
        session(['workStartDisabled' => false, 'breakInDisabled' => true, 'breakOutDisabled' => true, 'workEndDisabled' => true]);
    }
    return view('index', compact('user', 'attendances'));
}


    public function workStart(AttendanceRequest $request)
    {
        $user = Auth::user();
        $workStart = Attendance::where('user_id', $user->id)->latest()->first();


        if ((isset($workStart->break_in) && !isset($workStart->break_out)) || !isset($workStart) || isset($workStart->end_time)) {
            $workStart = Attendance::create(['user_id' => $user->id, 'start_time' => now(),]);
            session(['workStartDisabled' => true, 'breakInDisabled' => false, 'breakOutDisabled' => true, 'workEndDisabled' => false]);
        }
    
        return redirect('/');
    }
    


    public function workEnd(Request $request)
{
    $user = Auth::user();
    $workEnd = Attendance::where('user_id', $user->id)->get();

    if ((isset($workEnd->break_in) && !isset($workEnd->break_out)) || isset($workEnd->end_time)) {
        return redirect('/');
    } else {
        $workEnd = Attendance::create(['user_id' => $user->id, 'end_time' => Carbon::now()]);
    }

    session(['workEndDisabled' => true, 'breakInDisabled' => true, 'breakOutDisabled' => true, 'workStartDisabled' => false]);

$totals = (new Attendance())->totalMake($user);
$getTimes = (new Attendance())->getTimes($user);

    PureDate::create([
        'user_id' => Auth::id(),
        'start_time' => $getTimes['start_time'],
        'end_time' => $getTimes['end_time'], 
        'break_in' => $getTimes['break_in'],
        'break_out' => $getTimes['break_out'],
        'work_total' => $totals['work_total'],
        'break_total' => $totals['break_total'],
    ]);



    
    return redirect('/');
    
}


public function breakStart()
{
    $user = Auth::user();
    $breakStart = Attendance::where('user_id', $user->id)->latest()->first();

    if ($breakStart && ($breakStart->end_time || $breakStart->break_in)) {
        return redirect('/');
    } else {
        $attendances = Attendance::create(['user_id' => $user->id, 'break_in' => Carbon::now()]);
    }

    session(['workStartDisabled' => true, 'breakInDisabled' => true, 'breakOutDisabled' => false, 'workEndDisabled' => true]);

    return redirect('/');
}



public function breakEnd()
{
    $user = Auth::user();
    $breakEnd = Attendance::where('user_id', $user->id)->latest()->first();

    if ($breakEnd && ($breakEnd->start_time || $breakEnd->end_time || $breakEnd->break_out)) {
        return redirect('/');
    } else {
        $attendances = Attendance::create(['user_id' => $user->id, 'break_out' => Carbon::now()]);
    }
    session(['workStartDisabled' => true, 'breakInDisabled' => false, 'breakOutDisabled' => true, 'workEndDisabled' => false]);

    return redirect('/');
}

public function date()
{ 
    $user = Auth::user();
    Paginator::useBootstrap();
    $pureDates = PureDate::ｓｓwhere('user_id', \Auth::user()->id)->paginate(5);

    return view('date', compact('user', 'pureDates'));
}

public function allDate()
{ 
    $users = User::all();
Paginator::useBootstrap();
    $pureDates = PureDate::orderBy('start_time', 'desc')->paginate(5);    
    $pureDates->transform(function ($item, $key) {
        $item->start_time = \Carbon\Carbon::parse($item->start_time);
        return $item;
    });
    return view('alldate', compact('users', 'pureDates'));
}

}