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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->integer('fees');
            $table->string('specialization', 255);
            // Foreign key for the admin who added the doctor
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');

            $table->unsignedBigInteger('createdBy')->nullable(); // User ID for the creator
            $table->unsignedBigInteger('updatedBy')->nullable(); // User ID for the last updater
            $table->unsignedBigInteger('deletedBy')->nullable(); // User ID for the deleter (if soft deletes are used)

            // Custom timestamp fields
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->timestamp('deletedAt')->nullable();

            // Foreign key constraints
            $table->foreign('createdBy')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updatedBy')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('deletedBy')->references('id')->on('admins')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
