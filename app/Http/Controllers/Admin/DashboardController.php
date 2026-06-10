<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Document;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $articleViews = (int) Article::sum('views_count');
        $documentViews = (int) Document::sum('views_count');

        return view('admin.dashboard', [
            'stats' => [
                'articles' => Article::count(),
                'documents' => Document::count(),
                'views' => $articleViews + $documentViews,
                'users' => User::count(),
            ],
        ]);
    }
}

