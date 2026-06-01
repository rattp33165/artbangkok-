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
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['draft','submitted','under_review','approved','rejected'])->default('draft');
        $table->integer('completion_percent')->default(0);

        // Gallery Information
        $table->enum('gallery_type', ['international','thai'])->nullable();
        $table->string('gallery_name')->nullable();
        $table->year('year_founded')->nullable();
        $table->text('description')->nullable();
        $table->string('website_url')->nullable();
        $table->string('gallery_email')->nullable();
        $table->string('phone')->nullable();
        $table->string('instagram')->nullable();
        $table->string('facebook')->nullable();
        $table->json('gallery_images')->nullable();

        // Business Info
        $table->string('business_name')->nullable();
        $table->string('business_license')->nullable();

        // Head Office
        $table->string('office_country')->nullable();
        $table->string('office_city')->nullable();
        $table->string('office_zipcode')->nullable();
        $table->text('office_address')->nullable();
        $table->string('director_name')->nullable();
        $table->string('director_phone')->nullable();
        $table->string('director_email')->nullable();

        // Branches (JSON)
        $table->json('branches')->nullable();

        // Represented Artists
        $table->json('represented_artists')->nullable();

        // Booth
        $table->enum('booth_section', ['gallery','other'])->nullable();
        $table->enum('booth_type', ['A','B'])->nullable();

        // Person in charge
        $table->json('persons_in_charge')->nullable();

        // Art Fairs
        $table->json('art_fairs')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
