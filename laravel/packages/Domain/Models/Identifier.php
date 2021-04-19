<?php

namespace packages\Domain\Models;

abstract class Identifier implements \JsonSerializable
{
  //ここで与えらた要件は？
    /**
     * @var int $value
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
    //引数のselfは自身のクラスを指している。
    //値は普遍的
    /**
     * @param Identifier $value
     * @return bool
     */
    public function equals(self $value): bool
    {
        return $this->id === $value->id;
    }

    /**
     * @param int $value
     * @return static
     */
    public function of(int $value)
    {
        return new static($value);
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
