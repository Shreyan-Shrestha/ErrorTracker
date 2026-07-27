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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('gitlab_id');
            $table->foreignId('user_record_id')->constrained('user_records');
            $table->string('project_name');
            $table->string('status');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_sub_project', function(Blueprint $table){
            $table->id();
            $table->foreignId('parent_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('sub_project_id')->constrained('projects')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['parent_id', 'sub_project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_sub_project');
        Schema::dropIfExists('projects');
    }
};
