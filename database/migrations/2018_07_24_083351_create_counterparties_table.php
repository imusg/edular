<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterpartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparties', function (Blueprint $table) {
            $table->integer('id');
            $table->text('name');
            $table->text('site');
            $table->text('phone');
            $table->text('fax');
            $table->text('email');
            $table->text('vector_mf');
            $table->text('bank_request');
            $table->text('head_company');
            $table->text('id_1c');
            $table->date('create_date');
            $table->tinyInteger('type_company');
            $table->text('inn');
            $table->text('kpp');
            $table->integer('responsible_manager');
            $table->integer('status');
            $table->text('fullname');
            $table->text('kod_phone');
            $table->text('provider');
            $table->text('buyer');
            $table->text('id_parent');
            $table->text('managerment_post');
            $table->text('managerment_name');
            $table->text('ogrn');
            $table->text('okved');
            $table->text('info_fssp');
            $table->text('litigation');
            $table->text('owner');
            $table->text('need_for_premixes');
            $table->text('consumed_feed');
            $table->text('livestock');
            $table->tinyInteger('type_counterparties');
            $table->text('volume_of_consumption');
            $table->text('volume_of_sales');
            $table->tinyInteger('view_lead');
            $table->tinyInteger('action_company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparties');
    }
}
