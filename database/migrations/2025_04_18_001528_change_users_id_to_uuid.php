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
        Schema::table('users', function (Blueprint $table) {
            // $table->dropPrimary(); // Eliminar primary key actual
            // $table->renameColumn('id', 'old_id');
            $table->uuid('id')->change(); //casual
        });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->uuid('id')->primary()->first();
        //     $table->uuid('old_id')->change();
        // });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn('old_id');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('uuid', function (Blueprint $table) {
        //     //
        //     $table->dropPrimary();
        //     $table->renameColumn('id', 'uuid');
        // });
    }
};
