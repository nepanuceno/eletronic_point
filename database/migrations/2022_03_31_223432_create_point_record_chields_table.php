<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointRecordChieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_record_chields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id');
            $table->date('time_record');
            $table->timestamps();

            $table->foreign('point_id')->references('id')->on('point_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_record_chields');
    }
}
