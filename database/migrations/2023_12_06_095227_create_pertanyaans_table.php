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
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipe_jawabans_id');
            $table->unsignedBigInteger('layanans_id');
            $table->foreign('tipe_jawabans_id')->references('id')->on('tipe_jawabans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('layanans_id')->references('id')->on('layanans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaans');
    }
};
