<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use Datomatic\EnumHelper\Exceptions\InvalidUniqueId;

trait EnumUniqueId
{
    /**
     * Return the enum unique identifier (namespace + class name + case name).
     *
     * @return string
     */
    public function uniqueId(): string
    {
        return static::class . '.' . $this->name;
    }

    /**
     * Return an enum instance from a unique identifier.
     *
     * @return self
     * @throws InvalidUniqueId
     */
    public static function fromUniqueId(string $uniqueId): self
    {
        if (
            !strpos($uniqueId, '.')
            || substr_count($uniqueId, '.') !== 1
        ) {
            throw InvalidUniqueId::uniqueIdFormatIsInvalid($uniqueId);
        }

        list($enumClass, $case) = explode('.', $uniqueId);

        if ($enumClass !== static::class) {
            throw InvalidUniqueId::wrongClassName($uniqueId);
        }

        $cases = array_filter(self::cases(), fn($c) => $c->name === $case);

        if (empty($cases)) {
            throw InvalidUniqueId::caseNotPresent($case);
        }

        return array_values($cases)[0];
    }
}
