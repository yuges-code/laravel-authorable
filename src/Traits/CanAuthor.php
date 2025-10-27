<?php

namespace Yuges\Authorable\Traits;

use Illuminate\Support\Collection;
use Yuges\Authorable\Config\Config;
use Yuges\Authorable\Interfaces\Authorable;
use Yuges\Authorable\Observers\AuthorObserver;

trait CanAuthor
{
    use HasAuthorships;

    protected static function bootCanAuthor(): void
    {
        static::observe(Config::getAuthorObserverClass(AuthorObserver::class));
    }

    /** @return Collection<array-key, class-string<Authorable>> */
    public function getAuthorables(): Collection
    {
        $relation = Config::getAuthorableRelationName('authorable');

        return $this->authorships()->getQuery()->with($relation)->get()->pluck($relation);
    }
}
