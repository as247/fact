<?php

namespace As247\Fact\Contracts\Support;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     *
     * @return \As247\Fact\Contracts\Support\MessageBag
     */
    public function getMessageBag();
}
