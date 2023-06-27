<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('neighborhood_id');
            $table->string('number')->unique();
            $table->string('head_family');
            $table->integer('total_member')->default(1);
            $table->text('address');

            $table->timestamps();

            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->cascadeOnDelete();

            $table->index(['number', 'neighborhood_id']);
            $table->index('number');
            $table->index('neighborhood_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}
