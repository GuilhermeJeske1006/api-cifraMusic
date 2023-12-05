<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('name_note', 5);
            $table->timestamps();
        });

        DB::table('notes')->insert([
            ['name_note' => 'C'],
            ['name_note' => 'D'],
            ['name_note' => 'E'],
            ['name_note' => 'F'],
            ['name_note' => 'G'],
            ['name_note' => 'A'],
            ['name_note' => 'B'],
            ['name_note' => 'C#'],
            ['name_note' => 'D#'],
            ['name_note' => 'F#'],
            ['name_note' => 'G#'],
            ['name_note' => 'A#'],
            ['name_note' => 'Cb'],
            ['name_note' => 'Db'],
            ['name_note' => 'Eb'],
            ['name_note' => 'Fb'],
            ['name_note' => 'Gb'],
            ['name_note' => 'Ab'],
            ['name_note' => 'Bb'],
            ['name_note' => 'Cm'],
            ['name_note' => 'Dm'],
            ['name_note' => 'Em'],
            ['name_note' => 'Fm'],
            ['name_note' => 'Gm'],
            ['name_note' => 'Am'],
            ['name_note' => 'Bm'],
            ['name_note' => 'C#m'],
            ['name_note' => 'D#m'],
            ['name_note' => 'F#m'],
            ['name_note' => 'G#m'],
            ['name_note' => 'A#m'],
            ['name_note' => 'Cbm'],
            ['name_note' => 'Dbm'],
            ['name_note' => 'Ebm'],
            ['name_note' => 'Fbm'],
            ['name_note' => 'Gbm'],
            ['name_note' => 'Abm'],
            ['name_note' => 'Bbm'],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
