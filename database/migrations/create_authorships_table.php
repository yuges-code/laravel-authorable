<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Authorable\Config\Config;
use Yuges\Authorable\Models\Authorship;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getAuthorshipClass(Authorship::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        $relations = [
            'author' => Config::getAuthorRelationName('author'),
            'authorable' => Config::getAuthorableRelationName('authorable'),
        ];

        Schema::create($this->table, function (Blueprint $table) use ($relations) {
            if (Config::getAuthorshipKeyHas(true)) {
                $table->key(Config::getAuthorshipKeyType(KeyType::BigInteger));
            }

            $table->keyMorphs(
                Config::getAuthorKeyType(KeyType::BigInteger),
                $relations['author'],
            );

            $table->keyMorphs(
                Config::getAuthorableKeyType(KeyType::BigInteger),
                $relations['authorable'],
            );

            $table->order();
            $table->unique([
                $relations['author'] . '_id',
                $relations['author'] . '_type',
                $relations['authorable'] . '_id',
                $relations['authorable'] . '_type',
            ]);

            $table->timestamps();
        });
    }
};
