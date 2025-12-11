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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->enum('price_type', ['monthly', 'yearly', 'one_time'])->default('one_time');
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('features')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('demo_username')->nullable();
            $table->string('demo_password')->nullable();
            $table->string('owner_name');
            $table->string('owner_whatsapp');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('demo_clicks')->default(0);
            $table->unsignedBigInteger('whatsapp_clicks')->default(0);
            $table->timestamps();
            
            $table->index(['status', 'is_featured']);
            $table->index('category_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
