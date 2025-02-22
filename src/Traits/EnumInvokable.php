<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\UndefinedCase;

trait EnumInvokable
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
     * @throws UndefinedCase
     */
    public static function __callStatic(string $enumName, array $args): string|int
    {
        foreach (self::cases() as $case) {
            $check1 = strtolower($case->name);
            $check2 = str_replace('_', '',strtolower($case->name));
            if (
                $check1 === strtolower($enumName)
                || $check1 === strtolower(self::snake($enumName))
                || $check1 === strtolower(str_replace('_', '', $enumName))
                || $check2 === strtolower($enumName)
                || $check2 === strtolower(self::snake($enumName))
                || $check2 === strtolower(str_replace('_', '', $enumName))
            ) {
                return $case instanceof BackedEnum ? $case->value : $case->name;
            }
        }

        throw new UndefinedCase(self::class, $enumName);
    }

    /**
     * return snake case of a string.
     */
    protected static function snake(string $value): string
    {
        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.'_', $value), 'UTF-8');
        }

        return $value;
    }
}
