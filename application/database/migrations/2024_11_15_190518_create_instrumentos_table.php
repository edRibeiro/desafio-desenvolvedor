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
        Schema::create('instrumentos', function (Blueprint $table) {
            $table->id();
            $table->date('rptdt');
            $table->string('tckrsymb');
            $table->string('sctyctgynm')->nullable();
            $table->string('isin');
            $table->string('crpnnm')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumentos');
    }
};
