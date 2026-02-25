<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // nếu đã có cột role thì xóa
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

        });

        // thêm lại role mới
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('cuusinh')->index();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};