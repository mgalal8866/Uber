<?php

namespace App\Providers;

use App\Repository\DBUsersRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositoryinterface\UsersRepositoryinterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $repositories = [
            UsersRepositoryinterface::class               => DBUsersRepository::class
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
