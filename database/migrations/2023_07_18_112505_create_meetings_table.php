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
        Schema::create('meetings', function (Blueprint $table) {

            /**
             * for contextual info about the structure of the table,
             * refer to docs/feature-docs/meeting-migration
             */
            $table->uuid('id')->unique(); // string
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('description')->default('Just another meeting');
            $table->string('location')->default('Not specified');
            $table->string('timezone');
            $table->smallInteger('duration')->default('30');
            $table->integer('delete_after')->default('90');
            $table->boolean('is1v1')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
