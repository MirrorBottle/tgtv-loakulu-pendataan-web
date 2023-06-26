<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("family_id");
            $table->unsignedBigInteger("neighborhood_id");
            $table->string('id_number')->unique();
            $table->string('name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->enum('gender', ['L', 'P']);
            $table->enum('marital_status', ['K', 'BK', 'CH', 'CM']);
            $table->string('job');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('education');
            $table->string('address')->nullable();

            $table->boolean('is_death')->default(0);
            $table->boolean('is_birth')->default(0);
            $table->boolean('is_move_in')->default(0);
            $table->boolean('is_move_out')->default(0);

            $table->string('cause_of_death')->nullable();

            $table->dateTime('death_at')->nullable();
            $table->dateTime('born_at')->nullable();
            $table->dateTime('move_in_at')->nullable();
            $table->dateTime('move_out_at')->nullable();

            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families')->cascadeOnDelete();
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->cascadeOnDelete();


            $table->index(['id_number', 'family_id', 'neighborhood_id']);
            $table->index('id_number');
            $table->index('neighborhood_id');
            $table->index('family_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villagers');
    }
}
