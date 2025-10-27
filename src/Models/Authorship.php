<?php

namespace Yuges\Authorable\Models;

use Yuges\Package\Traits\HasTable;
use Yuges\Authorable\Config\Config;
use Yuges\Orderable\Traits\HasOrder;
use Yuges\Authorable\Traits\HasAuthor;
use Yuges\Package\Traits\HasTimestamps;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Illuminate\Database\Eloquent\Builder;
use Yuges\Authorable\Traits\HasAuthorable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Authorship extends MorphPivot implements Orderable
{
    use
        HasTable,
        HasOrder,
        HasAuthor,
        HasFactory,
        HasAuthorable,
        HasTimestamps;

    public $table = 'authorships';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getAuthorshipTable() ?? $this->table;
    }

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->query = fn (Builder $builder) => $builder
            ->where('authorable_id', $this->authorable_id)
            ->where('authorable_type', $this->authorable_type);

        return $options;
    }
}
