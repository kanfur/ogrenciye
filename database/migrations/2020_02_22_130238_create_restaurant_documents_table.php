<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('personnel')->nullable();
            $table->string('title')->nullable();
            $table->text('address')->nullable();
            $table->string('tax_administration')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('tic_sic_no')->nullable();
            $table->string('mersis_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('restaurant_documents', function (Blueprint $table) {
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_documents');
    }
}
