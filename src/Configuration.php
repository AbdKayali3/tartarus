<?php

namespace LaraZeus\Tartarus;

use Closure;
use LaraZeus\Tartarus\Concerns\HasNavGroupLabel;
use LaraZeus\Tartarus\Filament\Clusters\System\Resources\CompanyResource;
use LaraZeus\Tartarus\Filament\Clusters\System\Resources\EmailLogsResource;
use LaraZeus\Tartarus\Filament\Clusters\System\Resources\TagResource;
use LaraZeus\Tartarus\Filament\Pages\Deleter;

trait Configuration
{
    use HasNavGroupLabel;

    public Closure | array $defaultNavigationGroupLabel = [
        Deleter::class => 'Tartarus',
        CompanyResource::class => 'Tartarus',
        EmailLogsResource::class => 'Tartarus',
        TagResource::class => 'Tartarus',
    ];

    protected array $tartarusModels = [
        'Company' => \LaraZeus\Tartarus\Models\Company::class,
        'TagType' => \LaraZeus\Tartarus\Enums\TagTypes::class,
    ];

    protected array $disableResources = [];

    public function tartarusModels(array $models): static
    {
        $this->tartarusModels = $models;

        return $this;
    }

    public function getTartarusModels(): array
    {
        return $this->tartarusModels;
    }

    public static function getModel(string $model): string
    {
        return (new static())::get()->getTartarusModels()[$model];
    }

    public function disableResources(array $resources): static
    {
        $this->disableResources = $resources;

        return $this;
    }

    public function getDisabledResources(): ?array
    {
        return $this->disableResources;
    }
}
