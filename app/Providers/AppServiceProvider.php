<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\Staff\BookingRepositoryInterface;
use App\Repositories\Staff\PaymentRepository;
use App\Repositories\Staff\PaymentRepositoryInterface;
use App\Repositories\Staff\StaffAuthRepository;
use App\Repositories\Staff\StaffAuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class,
        );
        $this->app->bind(
            StaffAuthRepositoryInterface::class,
            StaffAuthRepository::class,
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


    }

}
