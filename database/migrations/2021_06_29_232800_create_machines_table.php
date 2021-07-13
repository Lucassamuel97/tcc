<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('manufacturer')->nullable();;
            $table->string('description');
            $table->string('identification_number');
            $table->string('engine_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('mounting_number')->nullable();
            $table->string('year_manufacture')->nullable();
            $table->string('model')->nullable();
            $table->unsignedBigInteger('hodometro');
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
        Schema::dropIfExists('machines');
    }
}
