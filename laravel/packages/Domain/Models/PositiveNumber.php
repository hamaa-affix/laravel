<?php

namespace packages\Domain\Models;

use packages\Exceptionns\InvariantException;

abstract class PositiveNumber implements \JsonSerializable
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @param int $value
     * @throws InvariantException
     */
    private function __construct(int $value = 0)
    {
        if ($value < 0) {
            throw new InvariantException('value must be positivenmber:' . $value);
        }
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return static
     */
    public static function of(int $value = 0)
    {
        return new static($value);
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
