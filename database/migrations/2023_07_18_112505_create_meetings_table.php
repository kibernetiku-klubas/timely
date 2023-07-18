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
            /*
                for contextual info about the structure
                of the table, refer to timely#9 on the projects board.
            */
            $table->uuid('id')->unique(); // string
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('description')->default('Just another meeting');
            $table->string('location')->default('Not specified');
            $table->smallInteger('timezone')->default('0');
            $table->smallInteger('duration')->default('30');
            $table->integer('meet_times')->default('{}');
            $table->integer('delete_after')->default('90');
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
