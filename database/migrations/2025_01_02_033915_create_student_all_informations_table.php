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
        Schema::create('student_all_informations', function (Blueprint $table) {
            $table->id();

$table->string('MName_uni');
$table->string('ElhaqNo');
$table->string('Ara_MName');
$table->integer('MType');
$table->integer('Stage');
$table->integer('StageSerial');
$table->string('Vill_uni');
$table->string('Post_uni');
$table->date('Estabilishyear');
$table->string('Principle');
$table->string('Year');
$table->integer('TID');
$table->integer('ids');
$table->integer('SL');
$table->string('Mobile');
$table->string('Mobile_2');
$table->integer('NMSerail');
$table->timestamp('created_at')->useCurrent();
$table->timestamp('updated_at')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_all_informations');
    }
};
