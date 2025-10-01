<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agenda_items', function (Blueprint $t){
            $t->id();
            $t->string('title'); $t->string('slug',180)->unique();
            $t->string('excerpt',500)->nullable(); $t->longText('body')->nullable();
            $t->enum('status',['draft','published','archived'])->default('draft')->index();
            $t->string('cover_path')->nullable();
            $t->dateTime('start_at')->index(); $t->dateTime('end_at')->nullable();
            $t->string('location')->nullable(); $t->string('organizer')->nullable();
            $t->string('meta_title',60)->nullable(); $t->string('meta_description',160)->nullable();
            $t->timestamp('published_at')->nullable()->index();
            $t->foreignId('created_by')->constrained('users');
            $t->foreignId('updated_by')->nullable()->constrained('users');
            $t->foreignId('published_by')->nullable()->constrained('users');
            $t->softDeletes(); $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_items');
    }
};
