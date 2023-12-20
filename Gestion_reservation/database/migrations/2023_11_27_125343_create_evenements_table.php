<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('libelle');
            $table->dateTime('date_limite_inscription');
            $table->string('image_mise_en_avant');
            $table->text('description');
            $table->string('lieu');
            $table->enum('est_cloturer_ou_pas', ['En_cours','Cloture'])->default('En_cours');
            $table->dateTime('date_evenement');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
