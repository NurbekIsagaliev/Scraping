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
        Schema::create('parsed_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('flId');
            $table->text('flTypeId');
            $table->text('flText');
            $table->text('flType');
            $table->text('flSubType');
            $table->text('flCato');
            $table->bigInteger('flRca');
            $table->bigInteger('parentId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parsed_data');
    }
};
