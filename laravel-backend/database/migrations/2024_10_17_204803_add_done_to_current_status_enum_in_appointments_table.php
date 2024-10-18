<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Import the DB facade

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE appointments MODIFY CurrentStatus ENUM('Active', 'CancelledByDoctor', 'CancelledByPatient', 'Done')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the change
        DB::statement("ALTER TABLE appointments MODIFY currentStatus ENUM('Active', 'CancelledByDoctor', 'CancelledByPatient')");
    }
};
