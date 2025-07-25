<?php

namespace Agenciafmd\Testimonies\Providers;

use Illuminate\Support\ServiceProvider;

class TestimonyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootProviders();

        $this->bootMigrations();

        $this->bootTranslations();

        $this->bootPublish();
    }

    public function register(): void
    {
        $this->registerConfigs();
    }

    private function bootProviders(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
    }

    private function bootPublish(): void
    {
        $this->publishes([
            __DIR__ . '/../../config' => base_path('config'),
        ], 'admix-testimonies:config');

        $this->publishes([
            __DIR__ . '/../../database/seeders/TestimonyTableSeeder.php' => base_path('database/seeders/TestimonyTableSeeder.php'),
        ], 'admix-testimonies:seeders');

        $this->publishes([
            __DIR__ . '/../../lang/pt_BR' => lang_path('pt_BR'),
        ], ['admix-testimonies:translations', 'admix-translations']);
    }

    private function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    private function bootTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'admix-testimonies');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../../lang');
    }

    private function registerConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix-testimonies.php', 'admix-testimonies');
        $this->mergeConfigFrom(__DIR__ . '/../../config/audit-alias.php', 'audit-alias');
    }
}
