<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumns('users', ['lastname','profile', 'cover','mobile', 'type','status'])){
            Schema::table('users', function (Blueprint $table) {
                $table->text('lastname');
                $table->longText('profile')->nullable();
                $table->longText('cover')->nullable();
                $table->integer('mobile');
                $table->integer('type');
                $table->boolean('status')->default(1);
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
        if(Schema::hasColumns('users', ['lastname','profile', 'cover','mobile', 'type','status'])){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('lastname');
                $table->dropColumn('profile')->nullable();
                $table->dropColumn('cover')->nullable();
                $table->dropColumn('mobile');
                $table->dropColumn('type');
                $table->dropColumn('status')->default(1);
            });
        }
    }
}
