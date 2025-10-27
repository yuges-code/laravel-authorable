<?php

namespace Yuges\Authorable\Observers;

use Illuminate\Database\Eloquent\Model;
use Yuges\Authorable\Interfaces\Authorable;

class AuthorableObserver
{
    public function saved(Authorable $authorable): void
    {
        $options = $authorable->authorable();

        if ($options->auto) {
            $authorable->attachAuthor();
        }
    }

    public function deleted(Authorable $authorable): void
    {
        if (! $authorable instanceof Model) {
            return;
        }

        if (method_exists($authorable, 'isForceDeleting') && ! $authorable->isForceDeleting()) {
            return;
        }

        $authorable->detachAuthors();
    }
}
