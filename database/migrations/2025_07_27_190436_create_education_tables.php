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
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });

    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('content')->nullable();
        $table->string('video_url')->nullable();
        $table->integer('order')->default(1);
        $table->timestamps();
    });

    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('lesson_progress', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started');
        $table->timestamps();
    });

    Schema::create('assignments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->enum('type', ['file', 'quiz']);
        $table->dateTime('due_date')->nullable();
        $table->timestamps();
    });

    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('content')->nullable(); // for text answers or quiz
        $table->string('file_path')->nullable(); // if file submission
        $table->float('score')->nullable();
        $table->timestamps();
    });

    Schema::create('files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
        $table->string('file_path');
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('quizzes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
        $table->text('question');
        $table->json('options'); // e.g. ["A", "B", "C", "D"]
        $table->string('correct_answer');
        $table->timestamps();
    });

    Schema::create('quiz_answers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('answer');
        $table->boolean('is_correct')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('files');
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('lesson_progress');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('courses');
    }
};
