<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Exceptions\TranslationMissing;
use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Exceptions\UndefinedStaticMethod;
use Illuminate\Support\Str;

trait LaravelEnum
{
    use EnumProperties;
    use EnumHelper {
        __callStatic as callStatic;
    }

    /**
     * Magic method to return different type of translation.
     */
    public function __call(string $method, array $parameters): string
    {
        return __(self::translateUniquePath($method) . '.' . $this->name, [], $parameters[0] ?? null);
    }

    protected static function translateUniquePath(string $method)
    {
        return 'enums.' . static::class . '.' . $method;
    }

    public static function __callStatic(string $method, array $parameters): string|array
    {
        try {
            return self::callStatic($method, $parameters);
        } catch (UndefinedCase $e) {
        }

        $results = [];
        $args = [$parameters[0] ?? null, $parameters[1] ?? null];

        if ($singularMethod = self::getSingularIfEndsWith($method, 'ByName')) {
            $results = static::dynamicByKey('name', $singularMethod, ...$args);
        } elseif ($singularMethod = self::getSingularIfEndsWith($method, 'ByValue')) {
            $results = static::dynamicByKey('value', $singularMethod, ...$args);
        } elseif ($singularMethod = self::getSingularIfEndsWith($method, 'AsSelect')) {
            $results = static::dynamicAsSelect($singularMethod, ...$args);
        } elseif (($singularMethod = Str::singular($method)) && $singularMethod !== $method) {
            $results = static::dynamicList($singularMethod, $parameters[0] ?? null, $parameters[1] ?? null);
        }

        if (! empty($results)) {
            $first = reset($results);
            if (is_string($first) && Str::of($first)->startsWith(self::translateUniquePath($singularMethod))) {
                throw new TranslationMissing(self::class, $singularMethod);
            }

            return $results;
        }

        throw new UndefinedStaticMethod(self::class, $method);
    }

    private static function getSingularIfEndsWith(string $method, string $string): string
    {
        return Str::of($method)->whenEndsWith(
            $string,
            fn ($str) => $str->rtrim($string)->singular(),
            fn ($str) => Str::of('')
        )->toString();
    }
}
