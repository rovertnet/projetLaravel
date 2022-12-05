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
        Schema::create('envois', function (Blueprint $table) {
            $table->id();
            $table->string('num_envoi');
            $table->string('montant_envoi');
            $table->unsignedInteger('id_devise');
            $table->string('expediteur');
            $table->string('beneficiaire');
            $table->string('phone_exp');
            $table->unsignedInteger('id_agence');
            $table->unsignedInteger('id_pays');
            $table->date('date_envois');
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
        Schema::dropIfExists('envois');
    }
};
