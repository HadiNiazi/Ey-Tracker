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
        Schema::create('student_school_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->date('previous_school_left_date')->nullable();
            $table->string('previous_school')->nullable();
            $table->string('reason_for_leaving')->nullable();
            $table->tinyText('previous_school_address')->nullable();

            $table->string('new_school')->nullable();
            $table->tinyText('new_school_address')->nullable();

            $table->boolean('student_missing_status')->nullable();
            $table->boolean('student_la_contacted')->nullable()->default(false);
            $table->string('student_missing_note')->nullable();
            $table->date('student_missing_date')->nullable();
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
        Schema::dropIfExists('student_school_details');
    }
};
