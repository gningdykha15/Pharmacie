<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoticesAndTraitementToMedicamentsTable extends Migration

{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            $table->text('notice')->nullable();
            $table->text('traitement')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            $table->dropColumn('notice');
            $table->dropColumn('traitement');
        });
    }
};
