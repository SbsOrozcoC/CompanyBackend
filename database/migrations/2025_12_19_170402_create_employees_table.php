<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');

            $table->string('identification')->unique();
            $table->string('address');
            $table->string('phone');

            $table->foreignId('city_id')->constrained()->restrictOnDelete();

            // Jerarquía (jefe)
            $table->foreignId('boss_id')
                ->nullable()
                ->references('id')
                ->on('employees')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
