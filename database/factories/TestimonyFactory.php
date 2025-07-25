<?php

namespace Agenciafmd\Testimonies\Database\Factories;

use Agenciafmd\Testimonies\Models\Testimony;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TestimonyFactory extends Factory
{
    protected $model = Testimony::class;

    public function definition(): array
    {
        return [
            'is_active' => fake()->optional(0.3, 1)
                ->randomElement([0]),
            'name' => fake()->sentence(3),
            'product' => fake()->sentence(),
            'description' => fake()->paragraph(),
        ];
    }

    public function withMedia(): TestimonyFactory
    {
        return $this->state(function (array $attributes) {
            return [
                //
            ];
        })
            ->afterCreating(function ($model) {
                $fakerDir = base_path('database/faker/testimonies/files/image');
                if (!File::isDirectory($fakerDir)) {
                    $fakerDir = __DIR__ . '/../faker/files/image';
                }

                $sourceFile = fake()->file($fakerDir, storage_path('media-library/temp'));
                $targetFile = Storage::putFile('tmp', new HttpFile($sourceFile));
                $model->doUpload($targetFile, 'image');
            });
    }
}
