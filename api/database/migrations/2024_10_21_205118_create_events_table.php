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
        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->decimal('prix', 8, 2)->nullable();
                $table->text('description');
                $table->date('date_start');
                $table->date('date_end');
                $table->string('location');
                $table->foreignId('organisateur_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('event_categories')->onDelete('cascade');
                $table->timestamps();
            });
    
        }}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
