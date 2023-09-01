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
        Schema::create('realms', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('emulator');
            $table->foreignId('auth_database_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('realmlist_id')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->unique([
                'auth_database_id',
                'realmlist_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realms');
    }
};
