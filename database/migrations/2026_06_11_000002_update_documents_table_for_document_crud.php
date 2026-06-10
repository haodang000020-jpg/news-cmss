<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (! Schema::hasColumn('documents', 'document_category_id')) {
                $table->foreignId('document_category_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('document_categories')
                    ->restrictOnDelete();
            }

            if (! Schema::hasColumn('documents', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title');
            }

            if (! Schema::hasColumn('documents', 'code')) {
                $table->string('code')->nullable()->after('slug');
            }

            if (! Schema::hasColumn('documents', 'issuer')) {
                $table->string('issuer')->nullable()->after('code');
            }

            if (! Schema::hasColumn('documents', 'issued_at')) {
                $table->date('issued_at')->nullable()->after('issuer');
            }

            if (! Schema::hasColumn('documents', 'effective_at')) {
                $table->date('effective_at')->nullable()->after('issued_at');
            }

            if (! Schema::hasColumn('documents', 'summary')) {
                $table->text('summary')->nullable()->after('effective_at');
            }

            if (! Schema::hasColumn('documents', 'file_path')) {
                $table->string('file_path')->nullable()->after('summary');
            }

            if (! Schema::hasColumn('documents', 'file_name')) {
                $table->string('file_name')->nullable()->after('file_path');
            }

            if (! Schema::hasColumn('documents', 'file_size')) {
                $table->integer('file_size')->nullable()->after('file_name');
            }

            if (! Schema::hasColumn('documents', 'download_count')) {
                $table->integer('download_count')->default(0)->after('file_size');
            }

            if (! Schema::hasColumn('documents', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('download_count');
            }

            if (! Schema::hasColumn('documents', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            }
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'document_category_id')) {
                $table->dropConstrainedForeignId('document_category_id');
            }

            $columns = [
                'slug',
                'code',
                'issuer',
                'issued_at',
                'effective_at',
                'summary',
                'file_path',
                'file_name',
                'file_size',
                'download_count',
                'is_featured',
                'is_active',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('documents', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
