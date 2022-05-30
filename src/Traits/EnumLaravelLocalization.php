<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

trait EnumLaravelLocalization
{
    use EnumDescription;

    /**
     * Only for Laravel: return the translated version of enum value.
     */
    public function description(?string $lang = null): string
    {
        return __('enums.' . static::class . '.' . $this->name, [], $lang);
    }
}
