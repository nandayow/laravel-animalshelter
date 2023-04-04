<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopters', function (Blueprint $table) { 
                $table->id();
                $table->string('image')->nullable();
                $table->integer('user_id');
                $table->string('fname');
                $table->string('lname'); 
                $table->string('phone');
                $table->string('addressline');
                $table->string('town');
                $table->string('zipcode');
                $table->date('birth_date');
                $table->string('gender');
                $table->string('email')->unique(); 
                $table->timestamp('email_verified_at')->nullable();
                $table->rememberToken();
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
        Schema::dropIfExists('adopters');
    }
}
