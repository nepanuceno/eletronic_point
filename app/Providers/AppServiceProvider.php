<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::directive('alertSuccess', function ($message) {
            $result = "if ($message) {
                    <script>MessageAlert(['$message', 'success', ". __('app.msg_success')."]);</script>
                }";
            return $result;
        });

        Blade::directive('alertDanger', function ($message) {
            $result = "if ($message) {
                    <script>MessageAlert(['$message', 'error', ". __('app.msg_error')."]);</script>
                }";
            return $result;
        });
    }
}
