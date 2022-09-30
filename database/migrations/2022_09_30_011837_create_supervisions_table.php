<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisions', function (Blueprint $table) {
            $table->unsignedInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('users');

            $table->unsignedInteger('blogger_id')->nullable();
            $table->foreign('blogger_id')->references('id')->on('users');

            $table->timestamps();

            $table->unique(['supervisor_id', 'blogger_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisions');
    }
}
