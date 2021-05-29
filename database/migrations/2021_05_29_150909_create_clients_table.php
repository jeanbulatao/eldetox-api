<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('selected_current_iso')->default('');
            $table->string('app_origin')->default('');
            $table->longText('location');
            $table->longText('uri');
            $table->string('uuid')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('verion')->nullable();
            $table->string('model')->nullable();
            $table->string('serail')->nullable();
            $table->string('platform');
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
        Schema::dropIfExists('clients');
    }
}
