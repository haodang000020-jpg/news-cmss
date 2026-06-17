<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountWebsiteVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        // Không tính lượt truy cập khu vực admin
        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        // Mỗi session chỉ tính 1 lượt
        if (! $request->session()->has('site_visit_counted')) {
            SiteVisit::create([
                'session_id' => $request->session()->getId(),
                'ip_hash' => $request->ip() ? hash('sha256', $request->ip()) : null,
                'user_agent_hash' => $request->userAgent() ? hash('sha256', $request->userAgent()) : null,
                'visited_at' => now(),
            ]);

            $request->session()->put('site_visit_counted', true);
        }

        return $next($request);
    }
}