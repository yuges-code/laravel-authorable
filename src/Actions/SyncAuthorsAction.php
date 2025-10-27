<?php

namespace Yuges\Authorable\Actions;

use Illuminate\Support\Collection;
use Yuges\Authorable\Interfaces\Author;
use Yuges\Authorable\Interfaces\Authorable;

class SyncAuthorsAction
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
     * @param Collection<array-key, Author> $authors
     */
    public function execute(Collection $authors): Authorable
    {
        $this->authorable
            ->detachAuthors()
            ->attachAuthors($authors);

        return $this->authorable;
    }
}
