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
        Schema::create('student_emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            
            $table->string('name_1')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('relationship_1')->nullable();

            $table->string('name_2')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('relationship_2')->nullable();

            $table->string('name_3')->nullable();
            $table->string('phone_3')->nullable();
            $table->string('relationship_3')->nullable();
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
        Schema::dropIfExists('student_emergency_contacts');
    }
};
