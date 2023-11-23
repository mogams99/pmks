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
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menus_id');
            $table->unsignedBigInteger('roles_id');
            $table->foreign('menus_id')->references('id')->on('menus')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('roles_id')->references('id')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('select')->nullable()->default(false);
            $table->boolean('insert')->nullable()->default(false);
            $table->boolean('update')->nullable()->default(false);
            $table->boolean('delete')->nullable()->default(false);
            $table->boolean('print')->nullable()->default(false);
            $table->boolean('import')->nullable()->default(false);
            $table->boolean('export')->nullable()->default(false);
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
        Schema::dropIfExists('accesses');
    }
};
