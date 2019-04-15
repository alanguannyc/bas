<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinalJudgeNominationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_judge_nomination', function (Blueprint $table) {
            
            $table->integer('final_judge_id');
            $table->integer('nomination_id');
            $table->primary(['final_judge_id','nomination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExits('final_judge_nomination');
    }
}
