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
        Schema::create('aplly_aplications', function (Blueprint $table) {
            $table->id();
            $table->string('Certificate_Type');
            $table->string('Class_name');
            $table->string('student_bangla_name');
            $table->string('student_arabic_name');
            $table->string('student_english_name');
            $table->string('student_Father_name_bn');
            $table->string('student_Father_name_ar');
            $table->string('student_Father_name_en');
            $table->integer('Roll');
            $table->integer('reg_id');
            $table->integer('MID');
            $table->string('madrasha_name_en');
            $table->string('madrasha_name');
            $table->string('photo');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
$table->text('admin_message')->nullable();
            $table->timestamp('created_at')->useCurrent();
$table->timestamp('updated_at')->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplly_aplications');
    }
};
