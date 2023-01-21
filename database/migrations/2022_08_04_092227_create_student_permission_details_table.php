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
        Schema::create('student_permission_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->boolean('consent_1')->nullable()->default(0);
            $table->boolean('consent_2')->nullable()->default(0);
            $table->boolean('consent_3')->nullable()->default(0);
            $table->boolean('consent_4')->nullable()->default(0);
            $table->boolean('consent_5')->nullable()->default(0);
            $table->tinyText('additional_notes')->nullable();
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
        Schema::dropIfExists('student_permission_details');
    }
};
