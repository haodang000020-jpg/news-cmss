<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'views_count') && ! Schema::hasColumn('articles', 'view_count')) {
                $table->renameColumn('views_count', 'view_count');
            }
        });

        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'category_id')) {
                $table->foreignId('category_id')->after('id')->constrained()->restrictOnDelete();
            }

            if (! Schema::hasColumn('articles', 'user_id')) {
                $table->foreignId('user_id')->after('category_id')->constrained()->restrictOnDelete();
            }

            if (! Schema::hasColumn('articles', 'slug')) {
                $table->string('slug')->after('title')->unique();
            }

            if (! Schema::hasColumn('articles', 'summary')) {
                $table->text('summary')->nullable()->after('slug');
            }

            if (! Schema::hasColumn('articles', 'content')) {
                $table->longText('content')->after('summary');
            }

            if (! Schema::hasColumn('articles', 'thumbnail')) {
                $table->string('thumbnail')->nullable()->after('content');
            }

            if (! Schema::hasColumn('articles', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('status');
            }

            if (! Schema::hasColumn('articles', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_featured');
            }

            if (! Schema::hasColumn('articles', 'view_count') && ! Schema::hasColumn('articles', 'views_count')) {
                $table->unsignedBigInteger('view_count')->default(0)->after('published_at');
            }

            if (! Schema::hasColumn('articles', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('view_count');
            }

            if (! Schema::hasColumn('articles', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'meta_description')) {
                $table->dropColumn('meta_description');
            }

            if (Schema::hasColumn('articles', 'meta_title')) {
                $table->dropColumn('meta_title');
            }

            if (Schema::hasColumn('articles', 'published_at')) {
                $table->dropColumn('published_at');
            }

            if (Schema::hasColumn('articles', 'is_featured')) {
                $table->dropColumn('is_featured');
            }

            if (Schema::hasColumn('articles', 'thumbnail')) {
                $table->dropColumn('thumbnail');
            }

            if (Schema::hasColumn('articles', 'content')) {
                $table->dropColumn('content');
            }

            if (Schema::hasColumn('articles', 'summary')) {
                $table->dropColumn('summary');
            }

            if (Schema::hasColumn('articles', 'slug')) {
                $table->dropUnique('articles_slug_unique');
                $table->dropColumn('slug');
            }

            if (Schema::hasColumn('articles', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }

            if (Schema::hasColumn('articles', 'category_id')) {
                $table->dropConstrainedForeignId('category_id');
            }
        });

        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'view_count') && ! Schema::hasColumn('articles', 'views_count')) {
                $table->renameColumn('view_count', 'views_count');
            }
        });
    }
};
