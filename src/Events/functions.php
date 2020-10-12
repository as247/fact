<?php

namespace As247\Fact\Events;

use Closure;

if (! function_exists('As247\Fact\Events\queueable')) {
    /**
     * Create a new queued Closure event listener.
     *
     * @param  \Closure  $closure
     * @return \As247\Fact\Events\QueuedClosure
     */
    function queueable(Closure $closure)
    {
        return new QueuedClosure($closure);
    }
}
