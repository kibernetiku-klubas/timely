<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Read more about these migrations in docs/feature-docs/new-database-migration-for-meet-dates.md
     */
    public function up(): void
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('meeting_id')->constrained('meetings')->onDelete('cascade');
            $table->dateTime('date_and_time');
            $table->timestamps();
            $table->tinyInteger('selected')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dates');
    }
};
