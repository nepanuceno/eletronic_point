<?php

namespace App\Providers;

use App\View\Components\AlertSuccess;
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
            $result="<script>
                        MessageAlert(['$message', 'success', '". __('app.msg_success')."'])
                    </script>";
            return $result;
        });

        Blade::directive('alertError', function ($message) {
            $result = "<script>
                        MessageAlert(['$message', 'error', '". __('app.msg_error')."'])
                    </script>";
            return $result;
        });

        Blade::directive('alertInfo', function ($message) {
            $result = "<script>
                        MessageAlert(['$message', 'info', '". __('app.msg_error')."'])
                    </script>";
            return $result;
        });
    }
}
