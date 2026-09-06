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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();

            // Identitas template
            $table->string('name');
            $table->string('slug')->unique();

            // Kategori template
            $table->string('category')->nullable();

            // Harga
            $table->decimal('price', 12, 2)->default(0);

            // Deskripsi template
            $table->text('description')->nullable();

            // Preview / thumbnail
            $table->string('thumbnail')->nullable();

            // URL / identifier demo
            $table->string('demo_url')->nullable();

            // Background default template
            $table->string('background')->nullable();

            // Fitur template
            // Disimpan sebagai JSON, misalnya:
            // ["Musik Background", "RSVP & Ucapan", "Amplop Digital"]
            $table->json('features')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            // Urutan tampilan di katalog
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            // Index
            $table->index('category');
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
