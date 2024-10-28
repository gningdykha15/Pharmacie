<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAudioPathsToMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            $table->string('notice_audio_path')->nullable();
            $table->string('traitement_audio_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            $table->dropColumn('notice_audio_path');
            $table->dropColumn('traitement_audio_path');
        });
    }
};
