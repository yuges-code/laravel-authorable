<?php

namespace Yuges\Authorable\Traits;

use Illuminate\Support\Collection;
use Yuges\Authorable\Config\Config;
use Illuminate\Support\Facades\Auth;
use Yuges\Authorable\Models\Authorship;
use Yuges\Authorable\Interfaces\Author;
use Illuminate\Database\Eloquent\Model;
use Yuges\Authorable\Options\AuthorableOptions;
use Yuges\Authorable\Observers\AuthorableObserver;

trait HasAuthors
{
    use HasAuthorships;

    public function authorable(): AuthorableOptions
    {
        return new AuthorableOptions;
    }

    protected static function bootHasAuthors(): void
    {
        static::observe(Config::getAuthorableObserverClass(AuthorableObserver::class));
    }

    /** @return Collection<array-key, class-string<Author>> */
    public function getAuthors(): Collection
    {
        $relation = Config::getAuthorRelationName('author');

        return $this->authorships()->getQuery()->with($relation)->get()->pluck($relation);
    }

    public function author(?Author $author = null): static
    {
        return $this->attachAuthor($author);
    }

    public function unauthor(Author $author): static
    {
        return $this->detachAuthor($author);
    }

    public function isAuthor(Author $author): bool
    {
        $pivot = new Authorship();
        $relation = $pivot->author();

        $attributes = [
            $relation->getForeignKeyName() => $author instanceof Model ? $author->getKey() : null,
            $relation->getMorphType() => $author instanceof Model ? $author->getMorphClass() : null,
        ];

        $relation = $this->authorships();

        $relation->getQuery()->withAttributes($attributes);

        return $relation->getBaseQuery()->exists();
    }

    public function attachAuthor(?Author $author = null): static
    {
        $this->attachAuthors($author ? Collection::make([$author]) : null);

        return $this;
    }

    /**
     * @param Collection<array-key, Author> $authors
     */
    public function attachAuthors(?Collection $authors = null): static
    {
        Config::getAttachAuthorsAction($this)->execute($authors);

        return $this;
    }

    public function detachAuthor(Author $author): static
    {
        $this->detachAuthors(Collection::make([$author]));

        return $this;
    }

    /**
     * @param null|Collection<array-key, Author> $authors
     */
    public function detachAuthors(?Collection $authors = null): static
    {
        Config::getDetachAuthorsAction($this)->execute($authors);

        return $this;
    }

    /**
     * @param Collection<array-key, Author> $authors
     */
    public function syncAuthors(Collection $authors): static
    {
        Config::getSyncAuthorsAction($this)->execute($authors);

        return $this;
    }

    public function defaultAuthor(): ?Author
    {
        /** @var ?Author */
        $author = Auth::user();

        return $author;
    }
}
