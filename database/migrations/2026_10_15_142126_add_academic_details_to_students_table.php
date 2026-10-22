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
        Schema::table('students', function (Blueprint $table) {
            $table->string('enrollment_no', 30)->nullable()->after('name');
            $table->string('college')->nullable()->after('enrollment_no');
            $table->string('semester', 20)->nullable()->after('college');
            $table->string('subject')->nullable()->after('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['enrollment_no', 'college', 'semester', 'subject']);
        });
    }
};
