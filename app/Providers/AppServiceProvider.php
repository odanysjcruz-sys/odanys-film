<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perHour(10)->by($request->ip())
                ->response(function () {
                    return back()->withErrors([
                        'email' => 'Too many attempts. Please wait a while before sending another message.',
                    ]);
                });
        });
    }
}
