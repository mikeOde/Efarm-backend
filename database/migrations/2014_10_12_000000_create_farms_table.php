<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('farm_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('owner_id');
            $table->string('location')->nullable();       
            $table->string('image')->nullable();
            $table->decimal('lat')->nullable();
            $table->decimal('lng')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vegetables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('owner_id');
            $table->integer('quantity');
            $table->integer('price');          // per Kg   
            $table->string('image')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('owner_id');
            $table->integer('quantity');  // number of trees
            $table->integer('price');     // price to adopt one tree
            $table->string('image')->nullable();
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
        Schema::dropIfExists('users');
    }
}
