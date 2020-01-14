<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reader_id');
            $table->unsignedBigInteger('copy_id');
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('reader_id', 'fk_rents_reader_id')->references('id')->on('readers');
            $table->foreign('copy_id', 'fk_rents_copy_id')->references('id')->on('copies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents_relationship');
        Schema::dropIfExists('rents');
    }
}
