<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    protected function bootPersistentMiddleware(): void
    {
        Livewire::addPersistentMiddleware([
            //
        ]);
    }

    protected function bootUrlScheme(): void
    {
        if (str_starts_with(config('app.url'), 'https://') || $this->app->isProduction()) {
            URL::forceScheme('https');
        }
    }

    protected function ensureModelStictness(): void
    {
        Model::shouldBeStrict(! app()->isProduction());
    }

    protected function preventDestructiveCommands(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    protected function configureDefaultPasswordRules(): void
    {
        Password::defaults(fn (): Password => Password::min(8));
    }

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->bootPersistentMiddleware();
        $this->bootUrlScheme();
        $this->ensureModelStictness();
        $this->preventDestructiveCommands();
        $this->configureDefaultPasswordRules();
    }
}
