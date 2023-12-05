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
        Schema::create('rhythm_has_music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('music_id'); 
            $table->foreign('music_id')->references('id')->on('music')->onDelete("cascade");
            $table->unsignedBigInteger('rhythm_id'); 
            $table->foreign('rhythm_id')->references('id')->on('rhythms')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rhythm_has_music');
    }
};
