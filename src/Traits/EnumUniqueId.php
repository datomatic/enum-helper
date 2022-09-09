<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use Datomatic\EnumHelper\Exceptions\InvalidUniqueId;

trait EnumUniqueId
{
    /**
     * Return the enum unique identifier (namespace + class name + case name).
     */
    public function uniqueId(): string
    {
        return static::class.'.'.$this->name;
    }

    /**
     * Return an enum instance from a unique identifier.
     *
     * @throws InvalidUniqueId
     */
    public static function fromUniqueId(string $uniqueId): self
    {
        if (
            ! strpos($uniqueId, '.')
            || substr_count($uniqueId, '.') !== 1
        ) {
            throw InvalidUniqueId::uniqueIdFormatIsInvalid($uniqueId);
        }

        [$enumClass, $enumName] = explode('.', $uniqueId);

        if ($enumClass !== static::class) {
            throw InvalidUniqueId::wrongClassName($uniqueId);
        }

        foreach (self::cases() as $case) {
            if ($case->name === $enumName) {
                return $case;
            }
        }

        throw InvalidUniqueId::caseNotPresent($enumName);
    }
}
