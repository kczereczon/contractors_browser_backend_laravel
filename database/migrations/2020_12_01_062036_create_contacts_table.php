<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone', 9);
            $table->bigInteger("contractor_id")->nullable()->unsigned();
            $table->bigInteger("department_id")->nullable()->unsigned();
            $table->foreign('contractor_id')->references('id')->on('contractors');
            $table->foreign('department_id')->references('id')->on('departaments');
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
        Schema::dropIfExists('contacts');
    }
}
