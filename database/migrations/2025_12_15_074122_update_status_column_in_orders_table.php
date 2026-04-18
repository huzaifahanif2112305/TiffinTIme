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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', [
                'pending',
                'accepted',
                'in_progress',
                'completed',
                'cancelled',
                'rejected',
                'pickup_departed',
                'picked_up',
                'started_washing',
                'ironing',
                'ready_for_delivery',
                'delivered'
            ])->default('pending')->change();
        });
    }
};
