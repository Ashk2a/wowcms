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
        Schema::create('game_databases', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('realm_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('database_credential_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('type');
            $table->string('database');
            $table->timestamps();

            $table->unique([
                'realm_id',
                'type',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_databases');
    }
};
