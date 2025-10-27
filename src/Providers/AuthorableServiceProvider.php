<?php

namespace Yuges\Authorable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Authorable\Config\Config;
use Yuges\Authorable\Models\Authorship;
use Yuges\Authorable\Exceptions\InvalidAuthorship;
use Yuges\Authorable\Observers\AuthorshipObserver;

class AuthorableServiceProvider extends \Yuges\Package\Providers\PackageServiceProvider
{
    protected string $name = 'laravel-authorable';

    public function configure(Package $package): void
    {
        $authorship = Config::getAuthorshipClass(Authorship::class);

        if (! is_a($authorship, Authorship::class, true)) {
            throw InvalidAuthorship::doesNotImplementAuthorship($authorship);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('authorable')
            ->hasMigrations([
                'create_authorships_table',
            ])
            ->hasObserver($authorship, Config::getAuthorshipObserverClass(AuthorshipObserver::class));
    }
}
