<?php

namespace Yuges\Authorable\Actions;

use Illuminate\Support\Collection;
use Yuges\Authorable\Models\Authorship;
use Yuges\Authorable\Interfaces\Author;
use Illuminate\Database\Eloquent\Model;
use Yuges\Authorable\Interfaces\Authorable;

class AttachAuthorsAction
{
    public function __construct(
        protected Authorable $authorable
    ) {
    }

    public static function create(Authorable $authorable): self
    {
        return new static($authorable);
    }

    /**
     * @param null|Collection<array-key, Author> $authors
     */
    public function execute(?Collection $authors = null): Authorable
    {
        $authors ??= Collection::make([$this->authorable->defaultAuthor()]);

        $authors->each(function (Author $author) {
            $relation = $this->authorable->authorships();

            $relation->getQuery()->withAttributes($this->pivotValues($author));

            $relation->create();
        });

        return $this->authorable;
    }

    public function pivotValues(?Author $author = null): array
    {
        $pivot = new Authorship();
        $relation = $pivot->author();

        return [
            $relation->getForeignKeyName() => $author instanceof Model ? $author->getKey() : null,
            $relation->getMorphType() => $author instanceof Model ? $author->getMorphClass() : null,
        ];
    }
}
