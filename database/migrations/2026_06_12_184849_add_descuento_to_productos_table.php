<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function ($table) {
            $table->unsignedTinyInteger('descuento')
                ->default(0)
                ->after('precio');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function ($table) {
            $table->dropColumn('descuento');
        });
    }
};
