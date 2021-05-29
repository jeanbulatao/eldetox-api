<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('addresses')){
            Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('name');
                $table->string('state');
                $table->string('street');
                $table->string('city');
                $table->string('other_address_info');
                $table->string('zip')->default();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->boolean('is_default')->default(1);
                $table->boolean('status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('addresses')){
            Schema::dropIfExists('addresses');
        }
    }
}
