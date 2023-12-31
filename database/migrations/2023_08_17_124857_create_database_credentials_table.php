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
        Schema::create('database_credentials', static function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->unique()
                ->index();
            $table->string('host');
            $table->integer('port');
            $table->string('username');
            $table->text('password')->default('');
            $table->timestamps();

            $table->unique([
                'host',
                'port',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('databases');
    }
};
