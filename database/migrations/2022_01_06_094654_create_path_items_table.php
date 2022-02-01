<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('path_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('path_id');
            $table->year('year');
            $table->smallInteger('level');
            $table->foreignId('filiere_id');
            $table->boolean('school_certificate_removed');
            $table->string('status');
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
        Schema::dropIfExists('path_items');
    }
}
