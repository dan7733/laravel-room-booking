<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; // Nhớ có dòng này

return new class extends Migration
{
    public function up(): void
    {
        // Chuyển cột status sang kiểu VARCHAR(50) để chứa thoải mái mọi loại trạng thái
        DB::statement("ALTER TABLE bookings MODIFY status VARCHAR(50) DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Không cần viết gì ở đây
    }
};