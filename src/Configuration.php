<?php

namespace LaraZeus\Tartarus;

use Closure;

trait Configuration
{
    /**
     * the resources navigation group
     */
    protected Closure | string $navigationGroupLabel = 'Tartarus';

    protected array $tartarusModels = [
        'Company' => \LaraZeus\Tartarus\Models\Company::class,
        'TagType' => \LaraZeus\Tartarus\Enums\TagTypes::class,
    ];

    protected array $disableResources = [];

    public function navigationGroupLabel(Closure | string $label): static
    {
        $this->navigationGroupLabel = $label;

        return $this;
    }

    public function getNavigationGroupLabel(): Closure | string
    {
        return $this->evaluate($this->navigationGroupLabel);
    }

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
