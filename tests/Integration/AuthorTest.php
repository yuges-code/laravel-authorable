<?php

namespace Yuges\Authorable\Tests\Integration;

use Yuges\Authorable\Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Yuges\Authorable\Models\Authorship;
use Yuges\Authorable\Tests\Stubs\Models\User;
use Yuges\Authorable\Tests\Stubs\Models\Post;

class AuthorTest extends TestCase
{
    public function testAuthorPosts()
    {
        $user = User::query()->create([
            'name' => 'Georgy',
            'email' => 'goshasafonov@yandex.ru',
            'password' => 'test',
        ]);

        Auth::setUser($user);

        $post = Post::query()->create([
            'title' => 'Post',
        ]);

        if (! $post->isAuthor($user)) {
            $post->author($user);
        }

        $this->assertDatabaseHas(Authorship::getTableName(), [
            'author_id' => $user->getKey(),
            'author_type' => $user->getMorphClass(),
            'authorable_id' => $post->getKey(),
            'authorable_type' => $post->getMorphClass(),
        ]);

        $post->unauthor($user);

        $this->assertDatabaseMissing(Authorship::getTableName(), [
            'author_id' => $user->getKey(),
            'author_type' => $user->getMorphClass(),
            'authorable_id' => $post->getKey(),
            'authorable_type' => $post->getMorphClass(),
        ]);

        $post->update([
            'title' => 'Test',
        ]);
    }
}
