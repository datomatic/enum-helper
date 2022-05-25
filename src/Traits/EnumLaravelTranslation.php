<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

trait EnumLaravelTranslation
{
    use EnumBaseTranslation;

    /**
     * Only for Laravel: return the translated version of enum value.
     */
    public function translate(string $lang = null): string
    {
        return __('enums.' . static::class . '.' . $this->name, [], $lang);
    }
}
