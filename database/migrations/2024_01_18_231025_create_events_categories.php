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
        Schema::create('events_categories', function (Blueprint $table) {
            $table->foreignId('id_evenement')->constrained('events');
            $table->foreignId('id_category')->constrained('categories');
            $table->primary(['id_evenement', 'id_category']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_categories');
    }
};
