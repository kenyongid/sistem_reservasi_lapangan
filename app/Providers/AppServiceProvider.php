<?php

namespace App\Providers;

use App\Models\Reservasi;
use Illuminate\Support\ServiceProvider;
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
        View::composer('layout.components.admin.header', function ($view) {
            $reservasiMenunggu = Reservasi::with('lapangan')
                ->where('status', 'Menunggu')
                ->latest()
                ->take(5)
                ->get();

            $view->with([
                'jumlahReservasiMenunggu' => Reservasi::where('status', 'Menunggu')->count(),
                'reservasiMenungguTerbaru' => $reservasiMenunggu,
            ]);
        });
    }
}
