<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change enum to string to support expanded booth types
        DB::statement("ALTER TABLE applications MODIFY COLUMN booth_section VARCHAR(20) NULL");
        DB::statement("ALTER TABLE applications MODIFY COLUMN booth_type VARCHAR(10) NULL");

        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedInteger('booth_rate_standard')->nullable()->after('booth_type');
            $table->unsignedInteger('booth_rate_special')->nullable()->after('booth_rate_standard');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['booth_rate_standard', 'booth_rate_special']);
        });

        DB::statement("ALTER TABLE applications MODIFY COLUMN booth_section ENUM('gallery','other') NULL");
        DB::statement("ALTER TABLE applications MODIFY COLUMN booth_type ENUM('A','B') NULL");
    }
};
