<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('subjects', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('day')->nullable();
        $table->string('time')->nullable();
        $table->enum('level', ['primary', 'secondary']);
        $table->integer('class_level'); // 1 to 6 (standard/form)
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
        Schema::dropIfExists('subjects');
    }
};
