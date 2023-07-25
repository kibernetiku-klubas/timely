<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_id')->constrained('dates')->onDelete('cascade');
            $table->string('voted_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
