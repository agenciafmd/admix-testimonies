<?php

namespace Agenciafmd\Testimonies\Providers;

use Agenciafmd\Testimonies\Models\Testimony;
use Agenciafmd\Testimonies\Policies\TestimonyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Testimony::class => TestimonyPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }

    public function register(): void
    {
        $this->registerConfigs();
    }

    public function registerConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/gate.php', 'gate');
    }
}
