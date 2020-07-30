<?php


namespace App\Model\Link\ValueObject;


class Url
{
    private string $url;

    private function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Given url is not a valid url. Got: ' . $url);
        }

        $this->url = $url;
    }

    public static function fromString(string $url): self
    {
        return new self($url);
    }

    public function __toString(): string
    {
        return $this->url;
    }

    public function toString(): string
    {
        return $this->url;
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->url === $other->url;
    }
}