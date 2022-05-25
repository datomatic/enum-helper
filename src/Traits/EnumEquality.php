<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumEquality
{
    /**
     * Check if enum is equal to another enum or value (backed enum) or name (pure enum).
     */
    public function is(self|string|int $value): bool
    {
        if ($value instanceof self) {
            return $this === $value;
        }

        return $this instanceof BackedEnum ? $this->value === $value : $this->name === $value;
    }

    /**
     * is method inverse.
     */
    public function isNot(self|string|int $value): bool
    {
        return ! $this->is($value);
    }

    /**
     * Check if enum is into an array of enum or array of values (backed enum) or array of names (pure enum).
     *
     * @param array<self|string|int> $values
     */
    public function in(array $values): bool
    {
        if (empty($values)) {
            return false;
        }

        if ($values[0] instanceof self) {
            return in_array($this, $values, true);
        }

        return in_array($this instanceof BackedEnum ? $this->value : $this->name, $values, true);
    }

    /**
     * in method inverse.
     *
     * @param array<self|string|int> $values
     */
    public function notIn(array $values): bool
    {
        return ! $this->in($values);
    }
}
