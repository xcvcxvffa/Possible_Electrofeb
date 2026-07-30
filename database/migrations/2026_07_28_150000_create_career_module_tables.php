<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─── 1. Career Categories ───────────────────────────────────────────
        Schema::create('career_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable()->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('icon_media_id')->nullable()->constrained('media_files')->nullOnDelete();
            $table->foreignId('banner_media_id')->nullable()->constrained('media_files')->nullOnDelete();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // ─── 2. Departments ──────────────────────────────────────────────────
        Schema::create('departments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // ─── 3. Job Locations ────────────────────────────────────────────────
        Schema::create('job_locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('country')->default('India');
            $table->string('state')->nullable();
            $table->string('city');
            $table->string('office_name')->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // ─── 4. Job Types ────────────────────────────────────────────────────
        Schema::create('job_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('color', 20)->default('#3b82f6');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // ─── 5. Skills Master ────────────────────────────────────────────────
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('category')->nullable(); // technical, soft, domain
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // ─── 6. Careers (Jobs) ───────────────────────────────────────────────
        Schema::create('careers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('career_category_id')->nullable()->index();
            $table->uuid('department_id')->nullable()->index();
            $table->uuid('job_location_id')->nullable()->index();
            $table->uuid('job_type_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('job_code')->nullable()->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Salary
            $table->enum('salary_type', ['fixed', 'range', 'negotiable', 'not_disclosed'])->default('not_disclosed');
            $table->decimal('salary_min', 10, 2)->unsigned()->nullable();
            $table->decimal('salary_max', 10, 2)->unsigned()->nullable();
            $table->string('currency', 10)->default('INR');

            // Job Details
            $table->string('experience')->nullable(); // e.g. "2-4 years"
            $table->string('education')->nullable();
            $table->unsignedSmallInteger('vacancies')->default(1);
            $table->date('application_deadline')->nullable();

            // Flags
            $table->boolean('featured')->default(false);
            $table->boolean('urgent')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamp('published_at')->nullable();

            // Media
            $table->foreignId('banner_media_id')->nullable()->constrained('media_files')->nullOnDelete();
            $table->foreignId('brochure_media_id')->nullable()->constrained('media_files')->nullOnDelete();

            // Analytics
            $table->unsignedInteger('views_count')->default(0);

            // Audit
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        // ─── 7. Career Responsibilities (dynamic rows) ───────────────────────
        Schema::create('career_responsibilities', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->text('item');
            $table->unsignedInteger('sort_order')->default(0);
        });

        // ─── 8. Career Requirements ──────────────────────────────────────────
        Schema::create('career_requirements', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->text('item');
            $table->unsignedInteger('sort_order')->default(0);
        });

        // ─── 9. Career Benefits ──────────────────────────────────────────────
        Schema::create('career_benefits', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->text('item');
            $table->unsignedInteger('sort_order')->default(0);
        });

        // ─── 10. Career Skill Items (normalized) ────────────────────────────
        Schema::create('career_skill_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->string('proficiency')->nullable(); // beginner, intermediate, expert
            $table->unsignedInteger('sort_order')->default(0);
        });

        // ─── 11. Career FAQs ─────────────────────────────────────────────────
        Schema::create('career_faqs', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->text('question');
            $table->longText('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
        });

        // ─── 12. Career Documents ────────────────────────────────────────────
        Schema::create('career_documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->foreignId('media_id')->constrained('media_files')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('document_type')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
        });

        // ─── 13. Career Related Jobs ─────────────────────────────────────────
        Schema::create('career_related', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id');
            $table->uuid('related_career_id');
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->foreign('related_career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->unique(['career_id', 'related_career_id']);
        });

        // ─── 14. Career SEO ──────────────────────────────────────────────────
        Schema::create('career_seo', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->unique()->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->foreignId('og_image_media_id')->nullable()->constrained('media_files')->nullOnDelete();
            $table->json('schema_json')->nullable();
            $table->timestamps();
        });

        // ─── 15. Career Slug History ─────────────────────────────────────────
        Schema::create('career_slug_history', function (Blueprint $table) {
            $table->id();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();
            $table->string('old_slug');
            $table->timestamps();
        });

        // ─── 16. Job Applications ────────────────────────────────────────────
        Schema::create('job_applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('career_id')->index();
            $table->foreign('career_id')->references('id')->on('careers')->cascadeOnDelete();

            // Candidate Info
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('country')->nullable()->default('India');
            $table->string('city')->nullable();

            // Application
            $table->foreignId('resume_media_id')->nullable()->constrained('media_files')->nullOnDelete();
            $table->text('cover_letter')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();

            // Professional
            $table->string('current_company')->nullable();
            $table->string('experience')->nullable();
            $table->string('current_salary')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('notice_period')->nullable();

            // Status
            $table->enum('application_status', [
                'applied', 'under_review', 'shortlisted',
                'interview_scheduled', 'selected', 'rejected', 'hold', 'withdrawn'
            ])->default('applied');

            // HR Internal
            $table->text('remarks')->nullable();
            $table->boolean('duplicate_flag')->default(false);
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();
        });

        // ─── 17. Application Status History ─────────────────────────────────
        Schema::create('application_status_history', function (Blueprint $table) {
            $table->id();
            $table->uuid('application_id')->index();
            $table->foreign('application_id')->references('id')->on('job_applications')->cascadeOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('note')->nullable();
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('changed_at')->useCurrent();
        });

        // ─── 18. Interview Schedules ─────────────────────────────────────────
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('application_id')->index();
            $table->foreign('application_id')->references('id')->on('job_applications')->cascadeOnDelete();
            $table->string('interview_type'); // phone, video, in_person, technical
            $table->datetime('scheduled_at');
            $table->string('interviewer')->nullable();
            $table->string('location_or_link')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // ─── 19. HR Internal Notes ───────────────────────────────────────────
        Schema::create('hr_notes', function (Blueprint $table) {
            $table->id();
            $table->uuid('application_id')->index();
            $table->foreign('application_id')->references('id')->on('job_applications')->cascadeOnDelete();
            $table->text('note');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr_notes');
        Schema::dropIfExists('interview_schedules');
        Schema::dropIfExists('application_status_history');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('career_slug_history');
        Schema::dropIfExists('career_seo');
        Schema::dropIfExists('career_related');
        Schema::dropIfExists('career_documents');
        Schema::dropIfExists('career_faqs');
        Schema::dropIfExists('career_skill_items');
        Schema::dropIfExists('career_benefits');
        Schema::dropIfExists('career_requirements');
        Schema::dropIfExists('career_responsibilities');
        Schema::dropIfExists('careers');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('job_locations');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('career_categories');
    }
};
