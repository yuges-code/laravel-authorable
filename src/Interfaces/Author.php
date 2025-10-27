<?php

namespace Yuges\Authorable\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Author
{
    public function authorships(): HasMany;

    public function getAuthorables(): Collection;
}
