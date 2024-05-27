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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('PosManagement');
            $table->string('company_address')->default('Ria');
            $table->string('company_phone')->default('+997-9865327412');
            $table->string('company_email')->default('posmanagement@gmail.com');
            $table->string('company_fax')->default('+7845129');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
