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
    Schema::table('users', function (Blueprint $t) {
        $t->string('role')->default('editor'); // editor|publisher|admin
        $t->index('role');
    });
    }
    public function down(): void {
    Schema::table('users', fn(Blueprint $t)=>$t->dropColumn('role'));
    }
};
