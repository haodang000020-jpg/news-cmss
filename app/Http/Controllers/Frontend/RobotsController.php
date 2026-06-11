<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n\n";
        $content .= 'Sitemap: '.url('/sitemap.xml')."\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
