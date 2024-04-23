<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    public function up(): void
    {
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foto_id');
            $table->unsignedBigInteger('violation_id')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('violation_id')->references('id')->on('violations')->onDelete('cascade');
            $table->foreign('foto_id')->references('id')->on('fotos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report');
    }
}

