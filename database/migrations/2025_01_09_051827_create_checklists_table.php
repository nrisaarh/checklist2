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
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->string('year'); // Tahun
            $table->string('month'); // Bulan
            $table->string('item'); // Nama item (misalnya "Switch", "Fuse", dll)
            $table->string('pic')->nullable(); // PIC
            $table->string('status')->nullable(); // Status
            $table->text('note')->nullable(); // Catatan
            $table->boolean('checked')->default(false); // Checklist
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
