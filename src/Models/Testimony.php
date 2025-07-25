<?php

namespace Agenciafmd\Testimonies\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Admix\Traits\WithSlug;
use Agenciafmd\Testimonies\Database\Factories\TestimonyFactory;
use Agenciafmd\Testimonies\Observers\TestimonyObserver;
use Agenciafmd\Ui\Casts\AsSingleMediaLibrary;
use Agenciafmd\Ui\Traits\WithUpload;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ObservedBy([TestimonyObserver::class])]
class Testimony extends Model implements AuditableContract, HasMedia
{
    use Auditable, HasFactory, InteractsWithMedia, Prunable, SoftDeletes, WithScopes, WithSlug, WithUpload;

    protected array $defaultSort = [
        'is_active' => 'desc',
        'name' => 'asc',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'image' => AsSingleMediaLibrary::class,
        ];
    }

    public function prunable(): Builder
    {
        return static::query()
            ->where('deleted_at', '<=', now()->subYear());
    }

    protected static function newFactory(): TestimonyFactory|\Database\Factories\TestimonyFactory
    {
        if (class_exists(\Database\Factories\TestimonyFactory::class)) {
            return \Database\Factories\TestimonyFactory::new();
        }

        return TestimonyFactory::new();
    }
}
