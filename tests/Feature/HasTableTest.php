<?php

namespace Yuges\Authorable\Tests\Feature;

use Yuges\Authorable\Tests\TestCase;
use Yuges\Authorable\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
    }
}
