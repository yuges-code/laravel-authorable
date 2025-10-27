<?php

namespace Yuges\Authorable\Traits;

use Yuges\Authorable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Authorable\Interfaces\Authorable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property ?string $authorable_type
 * @property null|int|string $authorable_id
 * 
 * @property ?Authorable $authorable
 */
trait HasAuthorable
{
    public function authorable(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getAuthorableRelationName('authorable'));
    }
}
