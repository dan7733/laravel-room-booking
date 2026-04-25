<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Kiểm tra xem cột 'price' đã có chưa, nếu chưa có thì mới tạo
        if (!Schema::hasColumn('rooms', 'price')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->decimal('price', 12, 2)->default(0)->after('description');
            });
        }

        // 2. Kiểm tra xem cột 'status' đã có chưa, nếu chưa có thì mới tạo
        if (!Schema::hasColumn('rooms', 'status')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->enum('status', ['active', 'maintenance'])->default('active')->after('price');
            });
        }
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Xóa cột nếu rollback
            if (Schema::hasColumn('rooms', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('rooms', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};