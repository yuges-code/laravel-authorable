<?php

// Config for yuges/authorable

return [
    /*
     * FQCN (Fully Qualified Class Name) of the models to use for authorships
     */
    'models' => [
        'author' => [
            'key' => [
                'has' => true,
                'type' => Yuges\Package\Enums\KeyType::BigInteger,
            ],
            'default' => [
                'class' => \App\Models\User::class,
            ],
            'allowed' => [
                'classes' => [
                    \App\Models\User::class,
                ],
            ],
            'relation' => [
                'name' => 'author',
            ],
            'observer' => Yuges\Authorable\Observers\AuthorObserver::class,
        ],
        'authorable' => [
            'key' => [
                'has' => true,
                'type' => Yuges\Package\Enums\KeyType::BigInteger,
            ],
            'allowed' => [
                'classes' => [
                    # models...
                ],
            ],
            'relation' => [
                'name' => 'authorable',
            ],
            'observer' => Yuges\Authorable\Observers\AuthorableObserver::class,
        ],
        'authorship' => [
            'key' => [
                'has' => true,
                'type' => Yuges\Package\Enums\KeyType::BigInteger,
            ],
            'table' => 'authorships',
            'class' => Yuges\Authorable\Models\Authorship::class,
            'relation' => [
                'name' => 'authorship',
            ],
            'observer' => Yuges\Authorable\Observers\AuthorshipObserver::class,
        ],
    ],

    'permissions' => [
        'author' => [
            'auto' => true,
        ],
    ],

    'actions' => [
        'sync' => Yuges\Authorable\Actions\SyncAuthorsAction::class,
        'attach' => Yuges\Authorable\Actions\AttachAuthorsAction::class,
        'detach' => Yuges\Authorable\Actions\DetachAuthorsAction::class,
    ],
];
