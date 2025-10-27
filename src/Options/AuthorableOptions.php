<?php

namespace Yuges\Authorable\Options;

use Yuges\Authorable\Config\Config;

class AuthorableOptions
{
    /**
     * Auto author
     * 
     * @var bool
     */
    public bool $auto = true;

    public function __construct()
    {
        $this->auto = Config::getPermissionsAuthorAuto($this->auto);
    }
}
