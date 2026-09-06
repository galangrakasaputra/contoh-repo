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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();

            // Pemilik undangan
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Template yang digunakan
            $table->foreignId('template_id')
                ->nullable()
                ->constrained('templates')
                ->nullOnDelete();

            // ==================================================
            // DATA MEMPELAI PRIA
            // ==================================================
            $table->string('groom_name');
            $table->string('groom_nickname')->nullable();

            // ==================================================
            // DATA MEMPELAI WANITA
            // ==================================================
            $table->string('bride_name');
            $table->string('bride_nickname')->nullable();

            // ==================================================
            // ORANG TUA MEMPELAI PRIA
            // ==================================================
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();

            // ==================================================
            // ORANG TUA MEMPELAI WANITA
            // ==================================================
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();

            // ==================================================
            // PESAN PENGANTIN
            // ==================================================
            $table->text('message')->nullable();

            // ==================================================
            // BACKGROUND
            // ==================================================
            // default / custom
            $table->string('background_type')
                ->default('default');

            // Bisa berisi nama file, path, atau identifier background
            $table->string('background_value')->nullable();

            // ==================================================
            // STATUS UNDANGAN
            // ==================================================
            // draft / active / expired
            $table->string('status')
                ->default('draft');

            $table->timestamps();

            // Index
            $table->index('user_id');
            $table->index('template_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
