<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(\App\Models\Category::class)->constrained()->cascadeOnDelete();
            $table->json('specs')->nullable();
            $table->string('color_type')->default('Белый/Бурый');
            $table->integer('print_colors_count')->default(4);
            $table->string('dimensions')->default('По требованию заказчика');
            $table->boolean('complies_with_gost_fefco')->default(true);
            $table->string('photo')->nullable();
            $table->string('photo_brown')->nullable();
            $table->string('photo_white')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};