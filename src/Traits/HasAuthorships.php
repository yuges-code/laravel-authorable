<?php

namespace Yuges\Authorable\Traits;

use Illuminate\Support\Collection;
use Yuges\Authorable\Config\Config;
use Yuges\Authorable\Models\Authorship;
use Illuminate\Database\Eloquent\Model;
use Yuges\Authorable\Interfaces\Author;
use Yuges\Authorable\Interfaces\Authorable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection<array-key, Authorship> $authorships
 */
trait HasAuthorships
{
    public function authorships(): HasMany
    {
        $name = match (true) {
            $this instanceof Author => Config::getAuthorRelationName('author'),
            $this instanceof Authorable => Config::getAuthorableRelationName('authorable'),
        };

        /** @var Model $this */
        $relation = $this->hasMany(Config::getAuthorshipClass(Authorship::class), "{$name}_id");

        $relation->getQuery()->withAttributes(["{$name}_type" => $this->getMorphClass()]);

        return $relation;
    }
}
