<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('dashboardRoute', function () {
            return "<?php echo match(auth()->user()->role) {
                'admin' => route('admin.dashboard'),
                'lecturer' => route('lecturer.dashboard'),
                'student' => route('student.dashboard'),
                'staff' => route('staff.dashboard'),
                default => route('home'),
            }; ?>";
        });
    }
}
