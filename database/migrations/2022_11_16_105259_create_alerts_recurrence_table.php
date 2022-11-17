<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id('alert_id');
            $table->string('project_id');
            $table->dateTime('first_sent');
            $table->dateTime('last_send');
            $table->string('times_sent');
            $table->dateTime('first_send_time');
            $table->dateTime('last_send_time');
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
        Schema::dropIfExists('alerts_recurrence');
    }
};
