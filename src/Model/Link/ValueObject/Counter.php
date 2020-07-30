<?php


namespace App\Model\Link\ValueObject;


class Counter
{
    private int $count;

    function __construct()
    {
        $this->count = 0;
    }

    public function increment()
    {
        $this->count += 1;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->count === $other->count();
    }
}