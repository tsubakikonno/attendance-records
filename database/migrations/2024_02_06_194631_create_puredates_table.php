<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Attendance;
use App\Models\PureDate;
use App\Models\User;

class CreatePuredatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puredates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->datetime('break_in')->nullable();
            $table->datetime('break_out')->nullable();
            $table->integer('break_total')->nullable();
            $table->integer('work_total')->nullable();
            $table->timestamps();
        });

        $attendances = Attendance::all();
        foreach ($attendances as $attendance) {
            Puredate::create([
                'user_id' => $attendance->user_id,
                'start_time' => $attendance->start_time,
                'end_time' => $attendance->end_time,
                'break_in' => $attendance->break_in,
                'break_out' => $attendance->break_out,
                'break_total' => $attendance->break_total,
                'work_total' => $attendance->work_total,
                'created_at' => $attendance->created_at,
                'updated_at' => $attendance->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puredates');
    }
}
