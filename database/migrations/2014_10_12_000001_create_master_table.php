<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key',191)->unique();
            $table->text('value')->nullable();
        });
        DB::table('master')->insert(['key' => 'title', 'value' => '',]);
        DB::table('master')->insert(['key' => 'icon', 'value' => '',]);
        DB::table('master')->insert(['key' => 'head', 'value' => '',]);
        DB::table('master')->insert(['key' => 'header', 'value' => '',]);
        DB::table('master')->insert(['key' => 'footer', 'value' => '',]);
        DB::table('master')->insert(['key' => 'scripts', 'value' => '',]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master');
    }
}
