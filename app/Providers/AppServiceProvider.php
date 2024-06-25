<?php

namespace App\Providers;

use App\Repository\DBCarRepository;
use App\Repository\DBTripsRepository;
use App\Repository\DBUsersRepository;
use App\Repository\DBCreditRepository;
use App\Repository\DBDriverRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DBNotificationRepository;
use App\Repository\DBExtraServicesRepository;
use App\Repositoryinterface\CarRepositoryinterface;
use App\Repositoryinterface\TripsRepositoryinterface;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CreditRepositoryinterface;
use App\Repositoryinterface\DriverRepositoryinterface;
use App\Repositoryinterface\NotificationRepositoryinterface;
use App\Repositoryinterface\ExtraServicesRepositoryinterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $repositories = [
            UsersRepositoryinterface::class                => DBUsersRepository::class,
            CreditRepositoryinterface::class               => DBCreditRepository::class,
            ExtraServicesRepositoryinterface::class        => DBExtraServicesRepository::class,
            NotificationRepositoryinterface::class        => DBNotificationRepository::class,
            TripsRepositoryinterface::class                => DBTripsRepository::class,
            DriverRepositoryinterface::class                => DBDriverRepository::class,
            CarRepositoryinterface::class                => DBCarRepository::class,
        ];
        foreach ($repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
