<?php declare(strict_types=1);

namespace MpApiClient\Common\Util;

use Error;
use InvalidArgumentException;
use JsonSerializable;

abstract class AbstractStringEnum implements JsonSerializable
{

    // All possible types contained by the enum (must be set by child class)
    public const TYPES = [];

    // Name of the key used for enum field in arrays (must be set by child class)
    public const KEY_NAME = 'enum-key-name-not-set';

    protected const INVALID_VALUE_MSG = 'Invalid type [%s] provided, allowed is one of: %s';

    private string $value;

    final public function __construct(string $value)
    {
        if (!in_array($value, static::TYPES, true)) {
            throw new InvalidArgumentException(
                sprintf(static::INVALID_VALUE_MSG, $value, implode(', ', static::TYPES))
            );
        }

        $this->value = $value;
    }

    /**
     * Provides access to values using ::CONSTANT_NAME() interface.
     * @param string               $constantName
     * @param array<string, mixed> $arguments
     * @return static
     */
    public static function __callStatic(string $constantName, array $arguments): AbstractStringEnum
    {
        if (!defined(static::class . '::' . $constantName)) {
            throw new Error(
                sprintf('Call to undefined method %s::%s().', static::class, $constantName)
            );
        }

        return new static(constant(static::class . '::' . $constantName));
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function jsonSerialize(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(AbstractStringEnum $enum): bool
    {
        return $this === $enum || (static::class === get_class($enum) && $this->getValue() === $enum->getValue());
    }

    public function equalsOneOf(AbstractStringEnum ...$enums): bool
    {
        foreach ($enums as $enum) {
            if ($this === $enum || (static::class === get_class($enum) && $this->getValue() === $enum->getValue())) {
                return true;
            }
        }

        return false;
    }

    public function equalsValue(string $value): bool
    {
        if (!in_array($value, static::TYPES, true)) {
            throw new InvalidArgumentException(
                sprintf(static::INVALID_VALUE_MSG, $value, implode(', ', static::TYPES))
            );
        }

        return $this->getValue() === $value;
    }

    public function equalsOneOfValues(string ...$values): bool
    {
        $invalidValues = array_diff($values, static::TYPES);
        if ($invalidValues !== []) {
            throw new InvalidArgumentException(
                sprintf(static::INVALID_VALUE_MSG, implode(', ', $invalidValues), implode(', ', static::TYPES))
            );
        }

        return in_array($this->getValue(), $values, true);
    }

}
