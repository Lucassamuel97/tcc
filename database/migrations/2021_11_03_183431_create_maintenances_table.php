<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('range_hodometro');
            $table->integer('range_months');
            $table->unsignedBigInteger('last_hodometro');
            $table->date('last_months');
            $table->date('limit_date');
            $table->unsignedBigInteger('limit_hodometro');
            $table->foreignId('machine_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();	
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
        Schema::dropIfExists('maintenances');
    }
}
