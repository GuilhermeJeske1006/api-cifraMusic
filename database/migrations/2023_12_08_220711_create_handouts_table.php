<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('handouts', function (Blueprint $table) {
            $table->id();
            $table->string('cover_image')->nullable();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('handout_download')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handout_music');
        Schema::dropIfExists('handouts');

    }
};
