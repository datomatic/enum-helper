<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Contracts;

interface Comparable
{
    /**
     * Compare two cases: returns a negative int if $a < $b, 0 if equal, a positive int if $a > $b.
     */
    public static function compare(Comparable $a, Comparable $b): int;
}
