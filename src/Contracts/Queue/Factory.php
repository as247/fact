<?php

namespace As247\Fact\Contracts\Queue;

interface Factory
{
    /**
     * Resolve a queue connection instance.
     *
     * @param  string|null  $name
     * @return \As247\Fact\Contracts\Queue\Queue
     */
    public function connection($name = null);
}
