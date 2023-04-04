<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_categories', function (Blueprint $table){
            $table->id();
            $table->string('breed_name');
            $table->string('animal_type');
            $table->timestamps();
        });

        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('animal_name');
            $table->string('gender');
            $table->integer('approximate_age');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('rescuer_id');
            $table->string('healthstatus');
            $table->integer('vet_id')->nullable();
            $table->string('image')->nullable();
            $table->date('rescued_date');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('category_id')
            ->references('id')
            ->on('animal_categories')
            ->onDelete('cascade');

            $table->foreign('rescuer_id')
            ->references('id')
            ->on('rescuers')
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
        Schema::dropIfExists('animals');
        Schema::dropIfExists('animal_categories');
     
      
    }
}
