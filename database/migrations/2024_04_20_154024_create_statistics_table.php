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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade'); // onDelete soft deletes stats also if schedule is deleted
            $table->foreignId('team_id')->nullable()->constrained('teams');
            $table->foreignId('player_id')->nullable()->constrained('players');
            $table->string('game_jersey_nr');
            $table->string('played');
            $table->unsignedInteger('3-p')->default(0);
            $table->unsignedInteger('free_t')->default(0);
            $table->unsignedInteger('free_m')->default(0);
            $table->unsignedInteger('fouls')->default(0);
            $table->unsignedInteger('techincals')->default(0);
            $table->unsignedInteger('unsportsman')->default(0);
            $table->unsignedInteger('points')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
            $table->dropSoftDeletes();
    }
};
