<?php

namespace LaraZeus\Tartarus\Filament\Clusters\System\Resources\TagResource\Pages;

use LaraZeus\Chaos\Filament\ChaosResource\Pages\ChaosCreateRecord;
use LaraZeus\Tartarus\Filament\Clusters\System\Resources\TagResource;

class CreateTag extends ChaosCreateRecord
{
    protected static string $resource = TagResource::class;
}
