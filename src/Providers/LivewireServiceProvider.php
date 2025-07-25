<?php

namespace Agenciafmd\Testimonies\Providers;

use Agenciafmd\Testimonies\Livewire\Pages;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.testimonies.livewire.pages.files.index', Pages\Testimony\Index::class);
        Livewire::component('agenciafmd.testimonies.livewire.pages.files.component', Pages\Testimony\Component::class);
    }

    public function register(): void
    {
        //
    }
}
