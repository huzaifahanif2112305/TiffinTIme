<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_verifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id')->unique(); // one per seller
            $table->string('full_name');
            $table->string('cnic_number', 15);
            $table->text('address');
            $table->string('phone', 20);
            $table->string('cnic_front_image');
            $table->string('cnic_back_image');
            $table->string('profile_picture');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_verifications');
    }
};
