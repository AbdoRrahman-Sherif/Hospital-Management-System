<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            // Check if appointment_id column doesn't exist before adding it
            if (!Schema::hasColumn('prescriptions', 'appointment_id')) {
                $table->foreignId('appointment_id')->constrained()->after('patient_id'); // Add appointment_id column
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            // Drop foreign key if exists
            if (Schema::hasColumn('prescriptions', 'appointment_id')) {
                $table->dropForeign(['appointment_id']); 
                $table->dropColumn('appointment_id'); 
            }
        });
    }
};
