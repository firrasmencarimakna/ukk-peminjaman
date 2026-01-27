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
        // Using raw SQL because Laravel's change() for enums can be problematic in some DB versions
        DB::statement("ALTER TABLE loans MODIFY COLUMN status ENUM('pending', 'approved', 'returning', 'returned', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE loans MODIFY COLUMN status ENUM('pending', 'approved', 'returned', 'rejected') DEFAULT 'pending'");
    }
};
