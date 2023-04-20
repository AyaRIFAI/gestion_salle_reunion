<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 
        Schema::create('profs', function (Blueprint $table) {
            $table->id();
            $table->string('path_image')->nullable();
            $table->string("lastName", 50);
            $table->string("firstName", 50);
            $table->string("Tel", 15);
            $table->string('email');
            $table->foreignId('departement_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('prof');
    }
}
