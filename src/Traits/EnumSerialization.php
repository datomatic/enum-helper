<?php

declare(strict_types=1);

namespace Datomatic\EnumHelper\Traits;

use BackedEnum;
use Datomatic\EnumHelper\Exceptions\InvalidSerializedValue;

trait EnumSerialization
{
    /**
     * Return the enum unique identifier (FQN + case name).
     */
    public function serialize(): string
    {
        return static::class.'::'.$this->name;
    }

    /**
     * Return an enum instance from a unique identifier.
     *
     * @throws InvalidSerializedValue
     */
    public static function unserialize(string $value): self
    {
        if (
            ! strpos($value, '::')
            || substr_count($value, '::') !== 1
        ) {
            throw InvalidSerializedValue::serializedFormatIsInvalid($value);
        }

        [$enumClass, $enumName] = explode('::', $value);

        if ($enumClass !== static::class) {
            throw InvalidSerializedValue::wrongClassName($value);
        }

        foreach (self::cases() as $case) {
            if ($case->name === $enumName) {
                return $case;
            }
        }

        throw InvalidSerializedValue::caseNotPresent($enumName);
    }

    /**
     * Return value or name for json_encode. You need to implement JsonSerializable interface in your pure enum.
     */
    public function jsonSerialize(): string
    {
        return $this instanceof BackedEnum ? $this->value : $this->name;
    }
}
