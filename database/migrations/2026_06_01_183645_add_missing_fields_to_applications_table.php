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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('head_office_gallery_name')->nullable()->after('office_address');
            $table->json('participating_artists')->nullable()->after('booth_type');
            $table->json('exhibitions')->nullable()->after('participating_artists');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['head_office_gallery_name', 'participating_artists', 'exhibitions']);
        });
    }
};
