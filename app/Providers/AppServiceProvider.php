<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Configuration\Exceptions;

class AppServiceProvider extends ServiceProvider
{
   public function boot(): void
    {
        // Disable syntax highlighting in exceptions
        if (class_exists(Exceptions::class)) {
            $this->app->make(Exceptions::class)->renderable(function (\Throwable $e) {
                return null; // Let Laravel handle it normally
            });
        }
    }
}

