<?php

namespace Yuges\Authorable\Traits;

use Yuges\Authorable\Config\Config;
use Yuges\Authorable\Interfaces\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property ?string $author_type
 * @property null|int|string $author_id
 * 
 * @property ?Author $author
 */
trait HasAuthor
{
    public function author(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getAuthorRelationName('author'));
    }
}
