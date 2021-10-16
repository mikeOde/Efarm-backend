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
            $table->string('name');
            $table->string('description');
            $table->integer('owner_id');
            $table->integer('address_id')->nullable();
            $table->integer('farm_has_badges')->nullable();  // Might remove it
            $table->integer('review_id')->nullable();        
            $table->string('image')->nullable();
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

        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('owner_id'); 
            $table->integer('created_by_user_id')->nullable();   //It will hold the id of the user who customizes a box
            $table->integer('quantity');       // quantity of boxes available
            $table->integer('price');          // per box   
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('boxes_items', function (Blueprint $table) {
            $table->id();
            $table->string('box_id');
            $table->string('vegetable_id');
            $table->integer('weight');       // weight of each vegetable included      
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

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('owner_id');
            $table->integer('section_has_trees');  //?
            $table->integer('area');  
            $table->integer('price');              // Price to adopt the whole section   
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('farm_id');
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
