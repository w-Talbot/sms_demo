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
        Schema::create('activity_history', function (Blueprint $table) {
            $table->id();
            $table->string('sms_alert_id')->nullable();
            $table->string('sms_study_id')->nullable();
            $table->string('redcap_record_id')->nullable();
            $table->string('error_note')->nullable();
            $table->longText('error_message')->nullable();
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
        Schema::dropIfExists('activity_history');
    }
};
