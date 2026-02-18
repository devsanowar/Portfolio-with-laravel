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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->string('service_slug');
            $table->string('icon_class');
            $table->text('short_description');
            $table->longText('long_description');
            $table->string('delivery_time')->nullable();
            $table->longText('features')->nullable();
            $table->string('complete_project')->default(0);
            $table->string('rating')->nullable();
            $table->string('button_one')->nullable();
            $table->text('button_one_url')->nullable();
            $table->string('button_two')->nullable();
            $table->text('button_two_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
