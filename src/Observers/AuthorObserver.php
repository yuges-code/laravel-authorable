<?php

namespace Yuges\Authorable\Observers;

use Yuges\Authorable\Interfaces\Author;
use Illuminate\Database\Eloquent\Model;

class AuthorObserver
{
    public function deleted(Author $author): void
    {
        if (! $author instanceof Model) {
            return;
        }

        if (method_exists($author, 'isForceDeleting') && ! $author->isForceDeleting()) {
            return;
        }

        $author->authorships()->delete();
    }
}
