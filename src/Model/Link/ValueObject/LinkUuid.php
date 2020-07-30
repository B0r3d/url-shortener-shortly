<?php


namespace App\Model\Link\ValueObject;


use Ramsey\Uuid\Uuid;

class LinkUuid
{
    private string $uuid;

    private function __construct(string $uuid)
    {
        if(!Uuid::isValid($uuid)) {
            throw new \InvalidArgumentException('Given link id is not a valid UUID. Got: ' . $uuid);
        }

        $this->uuid = $uuid;
    }

    public static function fromString(string $uuid): self
    {
        return new self($uuid);
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public function equals($other): bool
    {
        if(!$other instanceof self) {
            return false;
        }

        return $other->uuid === $this->uuid;
    }
}