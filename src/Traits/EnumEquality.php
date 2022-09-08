<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumEquality
{
    /**
     * Check if enum is equal to another enum or value (backed enum) or name (pure enum).
     */
    public function is(null|self|string|int $value): bool
    {
        if ($value instanceof self) {
            return $this === $value;
        }

        if ($this instanceof BackedEnum
            && (
                $this->value === $value
                || (is_numeric($value) && $this->value === (int) $value)
            )
        ) {
            return true;
        }

        if ($this->name === $value) {
            return true;
        }

        return false;
    }

    /**
     * is method inverse.
     */
    public function isNot(null|self|string|int $value): bool
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

        if ($this instanceof BackedEnum) {
            if (in_array($this->value, $values, true)) {
                return true;
            }
            if (empty(array_filter($values, fn ($value) => ! is_numeric($value)))) {
                $intValues = array_map('intval', $values);
                if (in_array($this->value, $intValues, true)) {
                    return true;
                }
            }
        }

        return in_array($this->name, $values, true);
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
