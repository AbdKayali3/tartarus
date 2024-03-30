<?php

namespace LaraZeus\Tartarus\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaraZeus\Chaos\Concerns\ChaosModel;
use LaraZeus\Tartarus\Models\Concerns\ForCompany;
use LaraZeus\Tartarus\TartarusPlugin;

/**
 * @property int $id
 */
class Tag extends \Spatie\Tags\Tag
{
    use ChaosModel;
    use ForCompany;
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'type' => TartarusPlugin::getModel('TagType'),
        ];
    }
}
