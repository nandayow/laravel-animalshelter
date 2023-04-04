<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptedAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopted_animals', function (Blueprint $table) {
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('adopter_id'); 
            $table->string('status');
            $table->timestamps(); 
            
            $table->foreign('animal_id')
            ->references('id')
            ->on('animals')
            ->onDelete('cascade') ;

            $table->foreign('adopter_id')
            ->references('id')
            ->on('adopters')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adopted_animals');
    }
}
