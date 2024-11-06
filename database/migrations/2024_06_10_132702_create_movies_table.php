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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('movie_title');
            $table->string('image');
            $table->string('duration');
            $table->string('cast');
            $table->string('director');
            $table->integer('genre_id');
            $table->text('description');
            $table->string('trailer')->nullable();
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies', function(Blueprint $table) {
            $table->dropColumn('trailer');
        });
    }
};
