<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport; // Asegúrate de importar esta línea

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Passport::routes(); // Registra las rutas de Passport
        //$this->registerPolicies();

       // Registra las rutas de Passport
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Passport::ignoreRoutes();
    }
}
