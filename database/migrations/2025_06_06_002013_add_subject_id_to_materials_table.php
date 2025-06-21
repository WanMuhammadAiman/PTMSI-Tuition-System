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
        Schema::table('materials', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id')->after('user_id');
    
            // Optional: if you want to enforce referential integrity
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn('subject_id');
        });
    }
    
};
