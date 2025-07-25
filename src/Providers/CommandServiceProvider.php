<?php

namespace Agenciafmd\Testimonies\Providers;

use Agenciafmd\Testimonies\Models\Testimony;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            //
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $minutes = config('admix.schedule.minutes');

            $schedule->command('model:prune', [
                '--model' => [
                    Testimony::class,
                ],
            ])
                ->dailyAt("03:{$minutes}");
        });
    }
}
