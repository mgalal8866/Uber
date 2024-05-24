<?php

namespace App\Providers;

use App\Repository\DBUsersRepository;
use App\Repository\DBCreditRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DBNotificationRepository;
use App\Repository\DBExtraServicesRepository;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CreditRepositoryinterface;
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
