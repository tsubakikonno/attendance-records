<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = ['start_time', 'end_time','user_id', 'break_in', 'break_out', 'work_total', 'break_total'];
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';


    

public function totalMake($user) {


    $breakInDateTimeStrings = self::where('user_id', $user->id)->whereNotNull('break_in')->pluck('break_in');
    $breakInDateTimes = $breakInDateTimeStrings->map(function ($breakInDateTimeString) {
        return Carbon::parse($breakInDateTimeString);
    });
    
    $breakOutDateTimeStrings = self::where('user_id', $user->id)->whereNotNull('break_out')->pluck('break_out');
    $breakOutDateTimes = $breakOutDateTimeStrings->map(function ($breakOutDateTimeString) {
        return Carbon::parse($breakOutDateTimeString);
    });
    
    $startDateTimeStrings = self::where('user_id', $user->id)->whereNotNull('start_time')->pluck('start_time');
    $startDateTimes = $startDateTimeStrings->map(function ($startDateTimeString) {
        return Carbon::parse($startDateTimeString);
    });
    
    $endDateTimeStrings = self::where('user_id', $user->id)->whereNotNull('end_time')->pluck('end_time');
    $endDateTimes = $endDateTimeStrings->map(function ($endDateTimeString) {
        return Carbon::parse($endDateTimeString);
    });
    
    $diffArray = [];
    $diffbreakArray = [];
    $diffbreak = null;
    foreach ($breakInDateTimes as $indexbreak => $breakInDateTime) {
        $breakOutDateTime = $breakOutDateTimes[$indexbreak];
        $diffbreak = $breakOutDateTime->diffInMinutes($breakInDateTime);
    
        self::where('user_id', $user->id)->where('break_in', $breakInDateTimeStrings[$indexbreak])->update(['break_total' => gmdate('H:i:s', $diffbreak)]);
    }
    
    $diffbreakCarbon = Carbon::createFromTimestamp($diffbreak);
    
    
    foreach ($startDateTimes as $index => $startDateTime) {
        $endDateTime = $endDateTimes[$index];
        $diff = $endDateTime->diffInMinutes($startDateTime);
        $purediff = $diff - $diffbreak;
    
        self::where('user_id', $user->id)->where('start_time', $startDateTimeStrings[$index])->update(['work_total' => gmdate('H:i:s', $purediff)]);
    }
    


    $breakTotalSum = 0; 

for ($i = 0; $i < count($breakInDateTimes); $i++) {
    $breakInDateTime = $breakInDateTimes[$i];
    $breakOutDateTime = $breakOutDateTimes[$i];
    if ($endDateTime->gt($breakOutDateTime)) {

        $diffBreak = $breakOutDateTime->diffInMinutes($breakInDateTime);
        $breakTotalSum += $diffBreak;
    }
}
self::where('user_id', $user->id)->update(['break_total' => gmdate('H:i:s', $breakTotalSum)]);

    return ['work_total' => $purediff, 'break_total' =>  $breakTotalSum];
}

public function getTimes($user) {
    $startTime = Attendance::where('user_id', $user->id)->whereNotNull('start_time')->latest()->pluck('start_time')->first();
    $endTime = Attendance::where('user_id', $user->id)->whereNotNull('end_time')->latest()->pluck('end_time')->first();
    $breakIn = Attendance::where('user_id', $user->id)->orderBy('break_in', 'desc')->max('break_in');
    $breakOut = Attendance::where('user_id', $user->id)->orderBy('break_out', 'desc')->max('break_out');



$breakInNull = $breakIn !== null ? $breakIn : null;
$breakOutNull  = $breakOut !== null ? $breakOut : null;

    return ['start_time' => $startTime, 'break_in' => $breakInNull, 'break_out' => $breakOutNull, 'end_time' => $endTime];



    
    
}





}    
