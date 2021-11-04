<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('user_type_id'); // 0 FOR CUSTOMERS AND 1 FOR FARMERS
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
            
        });

        Schema::create('orders', function (Blueprint $table) {  // users order boxes that they already customized or customized by the farmers
            $table->id();
            $table->integer('user_id');
            $table->integer('owner_id');
            $table->integer('box_id');
            $table->integer('customer_address_id'); 
            $table->integer('quantity');    //in boxes
            $table->integer('price');
            $table->timestamps();
        });

        Schema::create('trees_adoptions', function (Blueprint $table) {  
            $table->id();
            $table->integer('user_id');
            $table->integer('tree_id');
            $table->timestamps();
        });

        Schema::create('vegetables_orders', function (Blueprint $table) {  
            $table->id();
            $table->integer('user_id');
            $table->integer('vegetable_id');
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
        Schema::dropIfExists('users');
    }
}
