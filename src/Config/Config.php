<?php

namespace Yuges\Authorable\Config;

use Yuges\Package\Enums\KeyType;
use Illuminate\Support\Collection;
use Yuges\Authorable\Models\Authorship;
use Yuges\Authorable\Interfaces\Author;
use Yuges\Authorable\Interfaces\Authorable;
use Yuges\Authorable\Observers\AuthorObserver;
use Yuges\Authorable\Actions\SyncAuthorsAction;
use Yuges\Authorable\Actions\AttachAuthorsAction;
use Yuges\Authorable\Actions\DetachAuthorsAction;
use Yuges\Authorable\Observers\AuthorableObserver;
use Yuges\Authorable\Observers\AuthorshipObserver;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'authorable';

    public static function getAuthorKeyHas(mixed $default = null): bool
    {
        return self::get('models.author.key.has', $default);
    }

    public static function getAuthorKeyType(mixed $default = null): KeyType
    {
        return self::get('models.author.key.type', $default);
    }

    /** @return class-string<Author> */
    public static function getAuthorDefaultClass(mixed $default = null): string
    {
        return self::get('models.author.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Author>> */
    public static function getAuthorAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.author.allowed.classes', $default)
        );
    }

    public static function getAuthorRelationName(mixed $default = null): string
    {
        return self::get('models.author.relation.name', $default);
    }

    /** @return class-string<AuthorObserver> */
    public static function getAuthorObserverClass(mixed $default = null): string
    {
        return self::get('models.author.observer', $default);
    }

    public static function getAuthorableKeyHas(mixed $default = null): bool
    {
        return self::get('models.authorable.key.has', $default);
    }

    public static function getAuthorableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.authorable.key.type', $default);
    }

    /** @return Collection<array-key, class-string<Authorable>> */
    public static function getAuthorableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.authorable.allowed.classes', $default)
        );
    }

    public static function getAuthorableRelationName(mixed $default = null): string
    {
        return self::get('models.authorable.relation.name', $default);
    }

    /** @return class-string<AuthorableObserver> */
    public static function getAuthorableObserverClass(mixed $default = null): string
    {
        return self::get('models.authorable.observer', $default);
    }

    public static function getAuthorshipKeyHas(mixed $default = null): bool
    {
        return self::get('models.authorship.key.has', $default);
    }

    public static function getAuthorshipKeyType(mixed $default = null): KeyType
    {
        return self::get('models.authorship.key.type', $default);
    }

    public static function getAuthorshipTable(mixed $default = null): string
    {
        return self::get('models.authorship.table', $default);
    }

    /** @return class-string<Authorship> */
    public static function getAuthorshipClass(mixed $default = null): string
    {
        return self::get('models.authorship.class', $default);
    }

    public static function getAuthorshipRelationName(mixed $default = null): string
    {
        return self::get('models.authorship.relation.name', $default);
    }

    /** @return class-string<AuthorshipObserver> */
    public static function getAuthorshipObserverClass(mixed $default = null): string
    {
        return self::get('models.authorship.observer', $default);
    }

    public static function getPermissionsAuthorAuto(mixed $default = false): bool
    {
        return self::get('permissions.author.auto', $default);
    }

    public static function getSyncAuthorsAction(
        Authorable $authorable,
        mixed $default = null
    ): SyncAuthorsAction
    {
        return self::getSyncAuthorsActionClass($default)::create($authorable);
    }

    /** @return class-string<SyncAuthorsAction> */
    public static function getSyncAuthorsActionClass(mixed $default = null): string
    {
        return self::get('actions.sync', $default);
    }

    public static function getAttachAuthorsAction(
        Authorable $authorable,
        mixed $default = null
    ): AttachAuthorsAction
    {
        return self::getAttachAuthorsActionClass($default)::create($authorable);
    }

    /** @return class-string<AttachAuthorsAction> */
    public static function getAttachAuthorsActionClass(mixed $default = null): string
    {
        return self::get('actions.attach', $default);
    }

    public static function getDetachAuthorsAction(
        Authorable $authorable,
        mixed $default = null
    ): DetachAuthorsAction
    {
        return self::getDetachAuthorsActionClass($default)::create($authorable);
    }

    /** @return class-string<DetachAuthorsAction> */
    public static function getDetachAuthorsActionClass(mixed $default = null): string
    {
        return self::get('actions.detach', $default);
    }
}
