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
        Schema::create('student_parent_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            
            $table->string('father_name')->nullable();
            $table->string('father_home_telephone')->nullable();
            $table->string('father_work_telephone')->nullable();
            $table->string('father_mobile')->nullable();
            $table->string('father_ocuupation')->nullable();
            $table->string('father_address')->nullable();

            $table->string('mother_name')->nullable();
            $table->string('mother_home_telephone')->nullable();
            $table->string('mother_work_telephone')->nullable();
            $table->string('mother_mobile')->nullable();
            $table->string('mother_ocuupation')->nullable();
            $table->string('mother_address')->nullable();

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
        Schema::dropIfExists('student_parent_details');
    }
};
