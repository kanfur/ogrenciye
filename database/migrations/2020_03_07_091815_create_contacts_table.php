<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable()->comment('üye girişi varsa');
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->boolean('isSent_mail')->default(0)->comment('mail bildirimi');
            $table->boolean('isRead')->default(0)->comment('okundu mu');
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
        Schema::dropIfExists('contacts');
    }
}
