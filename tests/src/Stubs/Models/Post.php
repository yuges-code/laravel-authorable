<?php

namespace Yuges\Authorable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Authorable\Traits\HasAuthors;
use Yuges\Authorable\Interfaces\Authorable;

class Post extends Model implements Authorable
{
    use HasAuthors;

    protected $table = 'posts';

    protected $guarded = ['id'];
}
