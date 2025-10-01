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
    Schema::create('photos', function (Blueprint $t){
        $t->id();
        $t->foreignId('album_id')->nullable()->constrained()->nullOnDelete();
        $t->string('title')->nullable(); $t->text('caption')->nullable();
        $t->string('path'); $t->dateTime('taken_at')->nullable();
        $t->timestamps(); $t->index(['album_id','taken_at']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
