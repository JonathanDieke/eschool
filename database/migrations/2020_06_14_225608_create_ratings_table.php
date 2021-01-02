<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer("student_id");
            $table->string("subject_code");
            $table->integer("teacher_id");
            $table->integer("qz1")->nullable()->default(0);
            $table->integer("qz2")->nullable()->default(0);
            $table->integer("qz3")->nullable()->default(0);
            $table->integer("assignment")->nullable()->default(0);
            $table->integer("examen")->nullable()->default(0);
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
        Schema::dropIfExists('ratings');
    }
}
