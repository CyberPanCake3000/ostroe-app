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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->float('OD_Sph')->nullable();
            $table->float('OD_Cyl')->nullable();
            $table->float('OD_ax')->nullable();
            $table->float('OS_Sph')->nullable();
            $table->float('OS_Cyl')->nullable();
            $table->float('OS_ax')->nullable();
            $table->float('Dpp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('birth_date');
            $table->dropColumn('OD_Sph');
            $table->dropColumn('OD_Cyl');
            $table->dropColumn('OD_ax');
            $table->dropColumn('OS_Sph');
            $table->dropColumn('OS_Cyl');
            $table->dropColumn('OS_ax');
            $table->dropColumn('Dpp');
        });
    }
};
