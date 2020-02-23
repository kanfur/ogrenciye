<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('university')->nullable();
            $table->string('faculty')->nullable();
            $table->string('department')->nullable();
            $table->string('stu_no')->nullable();
            $table->string('stu_document')->nullable();
            $table->boolean('confirmed')->nullable()->default(false);
            $table->dateTime('graduation_date')->nullable();
            $table->dateTime('entry_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('educations', function (Blueprint $table) {
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
        Schema::dropIfExists('educations');
    }
}
