<?php

namespace Yuges\Authorable\Exceptions;

use Exception;
use TypeError;
use Yuges\Authorable\Models\Authorship;

class InvalidAuthorship extends Exception
{
    public static function doesNotImplementAuthorship(string $class): TypeError
    {
        $authorship = Authorship::class;

        return new TypeError("Authorship class `{$class}` must implement `{$authorship}`");
    }
}
