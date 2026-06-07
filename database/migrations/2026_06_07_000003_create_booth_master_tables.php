<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booth_halls', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('label');
            $table->string('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('booth_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained('booth_halls')->onDelete('cascade');
            $table->string('type_code', 10);
            $table->string('label');
            $table->string('dimensions', 50)->nullable();
            $table->decimal('sqm', 6, 1);
            $table->unsignedSmallInteger('qty')->nullable();
            $table->string('note')->nullable();
            $table->string('group_key', 20)->nullable();
            $table->string('group_label')->nullable();
            $table->unsignedInteger('rate_standard');
            $table->unsignedInteger('rate_special');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['hall_id', 'type_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booth_types');
        Schema::dropIfExists('booth_halls');
    }
};
