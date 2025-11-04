<?php

namespace Yuges\Authorable\Interfaces;

use Illuminate\Support\Collection;
use Yuges\Authorable\Options\AuthorableOptions;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Authorable
{
    public function authorable(): AuthorableOptions;

    public function authorships(): HasMany;

    public function getAuthors(): Collection;

    public function author(?Author $author = null): static;

    public function unauthor(Author $author): static;

    public function isAuthor(?Author $author = null): bool;

    public function attachAuthor(?Author $author = null): static;

    public function attachAuthors(?Collection $authors = null): static;

    public function detachAuthor(Author $author): static;

    public function detachAuthors(?Collection $authors = null): static;

    public function syncAuthors(Collection $authors): static;

    public function defaultAuthor(): ?Author;
}
