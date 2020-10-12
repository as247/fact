<?php

declare(strict_types=1);

namespace As247\Fact\Doctrine\Inflector;

interface WordInflector
{
    public function inflect(string $word) : string;
}
