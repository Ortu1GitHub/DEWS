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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->integer('age'); 
            $table->integer('salary'); 
            // Foreign key referencing `schools`
            $table->foreignId('schools_id') // Clave foránea hacia `schools`
                  ->unique() // Asegura la relación 1:1
                  ->constrained('schools') // Relación con `schools`
                  ->onDelete('cascade'); // Elimina el profesor si se elimina la escuela
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
