<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('_medicaments', function (Blueprint $table) {
            $table->id();
            $table->String("nom");
            $table->date("dateExpiration")->nullable();
            $table->String("fabricant");
            $table->text("description")->nullable();
            $table->string("medicament_code")->unique();
            $table->string("code_barre")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_medicaments');
    }
};
