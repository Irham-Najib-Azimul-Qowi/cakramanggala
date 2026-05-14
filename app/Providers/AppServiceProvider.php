<?php

namespace App\Providers;

use App\Models\Kegiatan;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('layouts.app', function ($view) {
            $footerActivities = collect();

            try {
                if (Schema::hasTable('kegiatans')) {
                    $footerActivities = Kegiatan::query()
                        ->orderByDesc('tanggal_pelaksanaan')
                        ->limit(3)
                        ->get();
                }
            } catch (\Throwable $exception) {
                $footerActivities = collect();
            }

            $view->with('footerActivities', $footerActivities);
        });
    }
}
