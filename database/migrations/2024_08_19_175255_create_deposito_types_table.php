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
        Schema::create('deposito_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('return', 5, 2); //Bunga dalam persen, misal 3.00%
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposito_types');
    }
};
