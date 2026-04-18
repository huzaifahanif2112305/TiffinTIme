<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('availability_days')->nullable()->after('availability');
            $table->time('start_time')->nullable()->after('availability_days');
            $table->time('end_time')->nullable()->after('start_time');
            $table->boolean('is_recurring')->default(true)->after('end_time');
            $table->integer('stock_quantity')->nullable()->after('is_recurring');
            $table->string('category_tag')->nullable()->after('stock_quantity'); // Breakfast, Lunch, Dinner, All-Day
            $table->integer('priority_score')->default(0)->after('category_tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'availability_days',
                'start_time',
                'end_time',
                'is_recurring',
                'stock_quantity',
                'category_tag',
                'priority_score'
            ]);
        });
    }
};
