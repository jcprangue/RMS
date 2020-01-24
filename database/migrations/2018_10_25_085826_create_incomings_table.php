<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('control_num');
            $table->date('date_receive');
            $table->integer('office');
            $table->text('particulars');
            $table->integer('category');
            $table->decimal('amount');
            $table->string('check_no');
            $table->string('payee');
            $table->string('supplier');
            $table->string('type_leave');
            $table->text('date_leave');
            $table->integer('fa_category');
            $table->text('remarks');
            $table->integer('status');
            $table->dateTime('verified');
            $table->string('verified_by');
            $table->dateTime('deleted_at');

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
        Schema::dropIfExists('incomings');
    }
}
