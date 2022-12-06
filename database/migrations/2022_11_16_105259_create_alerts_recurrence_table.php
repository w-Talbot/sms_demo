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
            $table->string('study_id');
            $table->string('record_id_variable_name');
            $table->string('record_id');
            $table->string('form_event');
            $table->string('form_variable');
            $table->dateTime('first_sent');
            $table->dateTime('last_sent');
            $table->string('times_sent');
            $table->string('num_of_recurrences');
            $table->string('send_every_num_days');
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
