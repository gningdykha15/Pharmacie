<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicamentCodeToMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            $table->string('medicament_code')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            $table->string('medicament_code');
        });
    }
};
