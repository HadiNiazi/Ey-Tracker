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
        Schema::create('grade_objective', function (Blueprint $table) {
            $table->foreignId('grade_id')->constrained();
            $table->foreignId('sub_objective_id')->constrained();
            $table->foreignId('objective_id')->constrained();
            $table->date('objective_achieved_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_objective');
    }
};
