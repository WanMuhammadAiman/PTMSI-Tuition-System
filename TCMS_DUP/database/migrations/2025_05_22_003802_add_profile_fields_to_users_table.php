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
    Schema::table('users', function (Blueprint $table) {
       // $table->string('phone_number')->nullable();
       // $table->string('address')->nullable();
        $table->string('identification_number')->nullable();
        $table->string('education_level')->nullable(); // e.g., 'Primary' or 'Secondary'
        $table->string('education_sublevel')->nullable(); // e.g., 'Form 4'
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
