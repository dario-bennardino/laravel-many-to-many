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
        Schema::create('project_type', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            // colonna di relazione con projects
            $table->unsignedBigInteger('project_id');
            //FK su questa colonna
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete();
            //se viene eliminato un project o un type viene cancellato il record

            // colonna di relazione con type
            $table->unsignedBigInteger('type_id');
            // FK su questa colonna
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_type');
    }
};
