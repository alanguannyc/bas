<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTextNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('nominations', function (Blueprint $table) {
            $table->text('q1')->nullable()->change();
            $table->text('q2')->nullable()->change();
            $table->text('q3')->nullable()->change();
            $table->text('q4')->nullable()->change();
            $table->text('q5')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
