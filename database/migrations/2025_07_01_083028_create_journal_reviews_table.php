<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('journal_reviews')) {
            Schema::create('journal_reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('journal_submission_id');
                $table->foreign('journal_submission_id')
                    ->references('id')
                    ->on('journal_submissions')
                    ->onDelete('cascade');

                $table->foreignId('reviewer1_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->foreignId('reviewer2_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->foreignId('reviewer3_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->enum('evaluation', ['acceptable', 'minor_revisions', 'major_revisions', 'reject', 'publish_draft', 'published']);
                $table->text('reviewer_comments');
                $table->text('kpay_receipt')->nullable();
                $table->enum('status', ['draft', 'sent', 'resubmit', 'publish_draft', 'published'])->default('draft');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('journal_reviews');
    }
};
