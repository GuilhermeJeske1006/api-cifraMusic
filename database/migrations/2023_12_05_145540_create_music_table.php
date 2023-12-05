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
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('bpm')->nullable();
            $table->unsignedBigInteger('singer_id'); 
            $table->unsignedBigInteger('note_id'); 
            $table->unsignedBigInteger('rhythm_id'); 
            $table->longText('lyrics');
            $table->timestamps();

            $table->foreign('singer_id')->references('id')->on('singers')->onDelete("cascade");
            $table->foreign('note_id')->references('id')->on('notes')->onDelete("cascade");
            $table->foreign('rhythm_id')->references('id')->on('rhythms')->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
