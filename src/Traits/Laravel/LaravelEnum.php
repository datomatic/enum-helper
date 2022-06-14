<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits\Laravel;

use Datomatic\EnumHelper\EnumHelper;
use Datomatic\EnumHelper\Exceptions\TranslationMissing;
use Datomatic\EnumHelper\Exceptions\UndefinedCase;
use Datomatic\EnumHelper\Exceptions\UndefinedStaticMethod;
use Datomatic\EnumHelper\Traits\EnumProperties;
use Illuminate\Support\Str;

trait LaravelEnum
{
    use EnumProperties;
    use EnumHelper {
        __callStatic as callStatic;
    }

    /**
     * Magic method to return a translation.
     */
    public function __call(string $method, array $parameters): string
    {
        $translation = __(self::translateUniquePath($method) . '.' . $this->name, [], $parameters[0] ?? null);

        if (Str::of($translation)->startsWith(self::translateUniquePath($method))) {
            throw new TranslationMissing(self::class, $method);
        }

        return $translation;
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
            $results = static::dynamicList($singularMethod, ...$args);
        }

        if (empty($results)) {
            throw new UndefinedStaticMethod(self::class, $method);
        }

        return $results;
    }

    private static function getSingularIfEndsWith(string $method, string $string): ?string
    {
        if (Str::of($method)->endsWith($string)) {
            return Str::singular(Str::of($method)->rtrim($string));
        }

        return null;
    }
}
