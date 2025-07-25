<?php

namespace Agenciafmd\Testimonies\Database\Seeders;

use Agenciafmd\Testimonies\Models\Testimony;
use Illuminate\Database\Seeder;

class TestimonyTableSeeder extends Seeder
{
    protected int $total = 20;

    public function run(): void
    {
        Testimony::query()
            ->truncate();

        $this->command->getOutput()
            ->progressStart($this->total);

        collect(range(1, $this->total))
            ->each(function () {
                Testimony::factory()
                    ->withMedia()
                    ->create();

                $this->command->getOutput()
                    ->progressAdvance();
            });

        $this->command->getOutput()
            ->progressFinish();
    }
}
