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
        Schema::create('error_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_record_id');
            $table->foreignId('assign_id')->nullable();
            $table->string('region');
            $table->string('branch');
            $table->foreignId('project_id');
            $table->foreignId('problem_id');
            $table->foreignId('category_id');
            $table->string('impact')->nullable();
            $table->text('root_cause')->nullable();
            $table->text('trigger')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();     
            $table->string('estimated_down')->nullable();
            $table->string('document')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_reports');
    }
};
