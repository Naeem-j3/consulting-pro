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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            -> constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('expert_id')
            -> constrained('experts')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('day_id')
            -> constrained('days')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('A_date');
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
        Schema::dropIfExists('reservations');
    }
};
