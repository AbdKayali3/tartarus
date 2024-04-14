<?php

namespace LaraZeus\Tartarus\Concerns;

use Closure;

trait HasNavGroupLabel
{
    public Closure | array $navigationGroupLabel = [];

    public function navigationGroupLabel(Closure | array $resources): static
    {
        $this->navigationGroupLabel = $resources;

        return $this;
    }

    public function getNavigationGroupLabel(): Closure | array
    {
        return $this->navigationGroupLabel;
    }

    public function getLabel(string $resource): Closure | string
    {
        return $this->evaluate(
            array_merge(
                (new static())::get()->defaultNavigationGroupLabel,
                $this->getNavigationGroupLabel()
            )[$resource]
        );
    }
}
