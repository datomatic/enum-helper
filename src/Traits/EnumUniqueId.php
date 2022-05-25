<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;

trait EnumUniqueId
{
    /**
     * Return the enum name identifier (namespace + class name + case name).
     */
    public function uniqueId(): string
    {
        return static::class . '.' . $this->name;
    }
}
