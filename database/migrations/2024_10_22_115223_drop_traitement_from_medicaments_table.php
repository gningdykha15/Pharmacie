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
        Schema::table('_medicaments', function (Blueprint $table) {
            //
            $table->dropColumn('traitement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('_medicaments', function (Blueprint $table) {
            //
            $table->text('traitement')->nullable();
        });
    }
};
