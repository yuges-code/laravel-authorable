<?php

namespace Yuges\Authorable\Tests\Stubs\Models;

use Yuges\Package\Traits\HasKey;
use Yuges\Package\Traits\HasTable;
use Yuges\Authorable\Traits\CanAuthor;
use Yuges\Authorable\Interfaces\Author;
use Yuges\Package\Traits\HasTimestamps;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Author
{
    use CanAuthor, HasKey, HasTable, HasTimestamps;

    protected $table = 'users';

    protected $guarded = ['id'];
}
