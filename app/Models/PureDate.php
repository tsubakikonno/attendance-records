<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PureDate extends Model
{
    use HasFactory;

    protected $table = 'puredates';

    protected $fillable = [
        'user_id', 'start_time', 'end_time', 'break_in', 'break_out', 'work_total','break_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateWorkTotal()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);

        return $end->diffInMinutes($start);
    }

    public function calculateBreakTotal()
    {
        $breakin = Carbon::parse($this->break_in);
        $breakout = Carbon::parse($this->break_out);

        return $end->diffInMinutes($start);
    }

}
