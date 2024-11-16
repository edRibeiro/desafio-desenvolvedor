<?php

namespace App\Providers;

use App\Services\Files\FileService;
use App\Services\Files\FileServiceInterface;
use App\Services\Instrumentos\InstrumentoService;
use App\Services\Instrumentos\InstrumentoServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FileServiceInterface::class, FileService::class);
        $this->app->bind(InstrumentoServiceInterface::class, InstrumentoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
