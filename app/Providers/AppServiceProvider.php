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

        \Illuminate\Support\Facades\Validator::extend('custom_image', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof \Illuminate\Http\UploadedFile) {
                return false;
            }
            
            $extension = strtolower($value->getClientOriginalExtension());
            if (in_array($extension, ['heic', 'heif'])) {
                return true;
            }
            
            $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/bmp'];
            return $value->isValid() && (str_starts_with($value->getMimeType(), 'image/') || in_array($value->getMimeType(), $allowedMimes));
        });

        \Illuminate\Support\Facades\Validator::replacer('custom_image', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'File harus berupa gambar (format: jpeg, png, jpg, webp, heic, heif).');
        });

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
