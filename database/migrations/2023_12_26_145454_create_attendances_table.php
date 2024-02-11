<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();      
            $table->bigInteger('user_id')->unsigned(); 
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->datetime('break_in')->nullable(); 
            $table->datetime('break_out')->nullable(); 
            $table->time('break_total')->nullable(); 
            $table->time('work_total')->nullable(); 
    

            $table->timestamps();

        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('end_time');
        });
    }
}
