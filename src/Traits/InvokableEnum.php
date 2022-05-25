<?php

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\UndefinedCase;

trait InvokableEnum
{

    /**
     * Return the enum's value when it's $invoked().
     */
    public function __invoke(): string|int
    {
        return $this instanceof BackedEnum ? $this->value : $this->name;
    }

    /**
     * Return the enum's value or name when it's called ::STATICALLY(), ::statically() or ::Statically().
     *
     * @param $args
     * @throws UndefinedCase
     */
    public static function __callStatic(string $name, $args): string|int
    {
        foreach (self::cases() as $case) {
            if (
                strtolower($case->name) === strtolower($name)
                || strtolower($case->name) === strtolower(self::snake($name))
                || strtolower($case->name) === strtolower(str_replace('_', '', $name))
            ) {
                return $case instanceof BackedEnum ? $case->value : $case->name;
            }
        }

        throw new UndefinedCase(self::class, $name);
    }


    /**
     * return snake case of a string.
     */
    protected static function snake(string $value): string
    {
        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1' . '_', $value), 'UTF-8');
        }

        return $value;
    }
}