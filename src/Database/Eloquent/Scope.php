<?php

namespace As247\Fact\Database\Eloquent;

interface Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \As247\Fact\Database\Eloquent\Builder  $builder
     * @param  \As247\Fact\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model);
}
