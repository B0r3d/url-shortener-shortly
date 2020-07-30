<?php


namespace App\Model\Link\ValueObject;


class Hash
{
    private string $hash;

    private function __construct(string $hash)
    {
        if (!preg_match('/^[0-9A-Za-z]+$/', $hash)) {
            throw new \InvalidArgumentException('Invalid hash value provided. Got: ' . $hash);
        }

        $this->hash = $hash;
    }

    public static function fromString(string $hash): self
    {
        return new self($hash);
    }

    public function __toString(): string
    {
        return $this->hash;
    }

    public function toString(): string
    {
        return $this->hash;
    }

    public function equals($other)
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->hash === $other->toString();
    }
}