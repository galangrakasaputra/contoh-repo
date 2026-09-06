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
        Schema::table('weddings', function (Blueprint $table) {
            // Akad
            $table->date('akad_date')->nullable()->after('message');
            $table->time('akad_start_time')->nullable()->after('akad_date');
            $table->time('akad_end_time')->nullable()->after('akad_start_time');
            $table->text('akad_address')->nullable()->after('akad_end_time');
            $table->string('akad_maps_url')->nullable()->after('akad_address');

            // Resepsi
            $table->date('reception_date')->nullable()->after('akad_maps_url');
            $table->time('reception_start_time')->nullable()->after('reception_date');
            $table->time('reception_end_time')->nullable()->after('reception_start_time');
            $table->text('reception_address')->nullable()->after('reception_end_time');
            $table->string('reception_maps_url')->nullable()->after('reception_address');

            // Payment / Amplop
            $table->string('bank_name')->nullable()->after('reception_maps_url');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('account_name')->nullable()->after('account_number');
            $table->string('account_number_alt')->nullable()->after('account_name');
            $table->string('account_name_alt')->nullable()->after('account_number_alt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weddings', function (Blueprint $table) {
            $table->dropColumn([
                'akad_date',
                'akad_start_time',
                'akad_end_time',
                'akad_address',
                'akad_maps_url',
                'reception_date',
                'reception_start_time',
                'reception_end_time',
                'reception_address',
                'reception_maps_url',
                'bank_name',
                'account_number',
                'account_name',
                'account_number_alt',
                'account_name_alt',
            ]);
        });
    }
};
