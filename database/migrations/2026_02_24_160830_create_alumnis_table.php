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
    Schema::create('alumni', function (Blueprint $table) {
        $table->id();
        $table->string('student_code')->nullable()->index();  // MSSV
        $table->string('full_name');
        $table->string('email')->nullable()->index();
        $table->string('phone')->nullable();
        $table->string('faculty')->nullable();  // Khoa
        $table->string('major')->nullable();    // Ngành
        $table->unsignedSmallInteger('graduation_year')->nullable()->index();
        $table->string('job')->nullable();
        $table->string('company')->nullable();
        $table->string('address')->nullable();
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
