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
        Schema::table('patients', function (Blueprint $table) {
            $table->string('contact', 15)->nullable()->after('gender'); // Add contact column
        });
    }
    
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('contact'); // Remove contact column if the migration is rolled back
        });
    }
    };
