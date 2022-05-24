<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use ValueError;

trait EnumHelper
{

    /**
     * Return the enum's value when it's $invoked().
     *
     * @return string|int
     */
    public function __invoke(): string|int
    {
        return $this instanceof BackedEnum ? $this->value : $this->name;
    }

    /**
     * Return the enum's value or name when it's called ::STATICALLY(), ::statically() or ::Statically().
     *
     * @param string $name
     * @param $args
     * @return string|int
     * @throws UndefinedCase
     */
    public static function __callStatic(string $name, $args): string|int
    {
        $cases = self::cases();
        foreach ($cases as $case) {
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
     * return snake case of a string
     *
     * @param string $value
     * @return string
     */
    protected static function snake(string $value): string
    {
        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1' . '_', $value), 'UTF-8');
        }
        return $value;
    }

    /**
     * Get an array of case names
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get an array of case values
     *
     * @return array
     */
    public static function values(): array
    {
        $cases = self::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'value')
            : array_column($cases, 'name');
    }

    /**
     * Get an associative array of [case value => case name]
     *
     * @return array
     */
    public static function asArray(): array
    {
        $cases = self::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'name', 'value')
            : array_column($cases, 'name');
    }

    /**
     * Get an associative array of [case name => case value]
     *
     * @return array
     */
    public static function asArrayInverse(): array
    {
        $cases = self::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'value', 'name')
            : array_column($cases, 'name');
    }

    /**
     * Gets the Enum by name, if it exists, for "Pure" enums.
     *
     * This will not override the `from()` method on BackedEnums
     *
     * @throws ValueError
     */
    public static function from(string $case): static
    {
        return static::fromName($case);
    }

    /**
     * Gets the Enum by name, if it exists, for "Pure" enums.
     * This will not override the `tryFrom()` method on BackedEnums
     *
     * @param string $case
     * @return EnumHelper|null
     */
    public static function tryFrom(string $case): ?static
    {
        return static::tryFromName($case);
    }

    /**
     * Gets the Enum by name.
     *
     * @throws ValueError
     */
    public static function fromName(string $case): static
    {
        return self::tryFromName($case) ?? throw new ValueError('"' . $case . '" is not a valid name for enum "' . self::class . '"');
    }

    /**
     * Gets the Enum by name, if it exists.
     */
    public static function tryFromName(string $case): ?static
    {
        $cases = array_filter(
            self::cases(),
            fn($c) => $c->name === $case
        );

        return array_values($cases)[0] ?? null;
    }


    /**
     * Check if enum is equal to another enum or value (backed enum) or name (pure enum).
     *
     * @param EnumHelper|string|int $value
     * @return bool
     */
    public function is(self|string|int $value): bool
    {
        if ($value instanceof self) {
            return $this === $value;
        }

        return $this instanceof BackedEnum ? $this->value === $value : $this->name === $value;
    }

    /**
     * is method inverse
     *
     * @param EnumHelper|string|int $value
     * @return bool
     */
    public function isNot(self|string|int $value): bool
    {
        return !$this->is($value);
    }


    /**
     * Check if enum is into an array of enum or array of values (backed enum) or array of names (pure enum)
     *
     * @param array<EnumHelper|string|int> $values
     * @return bool
     */
    public function in(array $values): bool
    {
        if (empty($values)) {
            return false;
        }

        if ($values[0] instanceof self) {
            return in_array($this, $values, true);
        }

        return in_array($this(), $values, true);
    }

    /**
     * in method inverse
     *
     * @param array<EnumHelper|string|int> $values
     * @return bool
     */
    public function notIn(array $values): bool
    {
        return !$this->in($values);
    }


    /**
     * Return the enum name identifier (namespace + class name + case name)
     *
     * @return string
     */
    public function toString(): string
    {
        return static::class . '.' . $this->name;
    }

    /**
     * Only for Laravel: return the translated version of enum value
     *
     * @param string|null $lang
     * @return string
     */
    public function translate(string $lang = null): string
    {
        if (function_exists('__')) {
            return __('enums.' . $this->toString(), [], $lang);
        }
        return '';
    }

}
