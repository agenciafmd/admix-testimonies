<?php

namespace Agenciafmd\Testimonies\Livewire\Pages\Testimony;

use Agenciafmd\Testimonies\Models\Testimony;
use Agenciafmd\Ui\Traits\WithMediaSync;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    use WithMediaSync;

    public Testimony $testimony;

    #[Validate]
    public bool $is_active = true;

    #[Validate]
    public ?string $name = '';

    #[Validate]
    public ?string $product = '';

    #[Validate]
    public ?string $description = '';

    #[Validate]
    public array $image_files = [];

    #[Validate]
    public array $image_meta = [];

    #[Validate]
    public Collection $image;

    public function setModel(Testimony $testimony): void
    {

        $this->testimony = $testimony;
        $this->image = collect();
        $this->image_meta = [];
        if ($testimony->exists) {
            $this->is_active = $testimony->is_active;
            $this->name = $testimony->name;
            $this->product = $testimony->product;
            $this->image = $testimony->image;
            $this->image_meta = $this->image->pluck('meta')
                ->toArray();
            $this->description = $testimony->description;
        }
    }

    public function rules(): array
    {
        return [
            'is_active' => [
                'boolean',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'product' => [
                'nullable',
                'max:255',
            ],
            'description' => [
                'nullable',
                'max:350',
            ],
            'image_files.*' => [
                'image',
                'max:1024',
                Rule::dimensions()
                    ->ratio(1)
                    ->maxWidth(80)
                    ->maxHeight(80),
            ],
            'image' => [
                'array',
                'nullable',
            ],
            'image_meta' => [
                'array',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('admix-testimonies::fields.is_active'),
            'name' => __('admix-testimonies::fields.name'),
            'product' => __('admix-testimonies::fields.product'),
            'description' => __('admix-testimonies::fields.description'),
            'image' => __('admix-testimonies::fields.image'),
            'image_files' => __('admix-testimonies::fields.image'),
            'image_files.*' => __('admix-testimonies::fields.image'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $this->testimony->fill($this->except([
            'testimony',
            'image',
            'image_files',
            'image_meta',
        ]));

        if (!$this->testimony->exists) {
            $this->testimony->save();
        }

        $this->syncMedia($this->testimony, 'image');

        return $this->testimony->save();
    }
}
