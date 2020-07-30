<?php


namespace App\Tests\Model\Link\ValueObject;


use App\Model\Link\ValueObject\Hash;
use PHPUnit\Framework\TestCase;

class HashTest extends TestCase
{
    /** @test */
    public function valid_hash_can_be_created()
    {
        $hash = Hash::fromString('aZl8N0y58I7');

        $this->assertInstanceOf(Hash::class, $hash);
        $this->assertEquals('aZl8N0y58I7', $hash->toString());
    }

    /** @test */
    public function it_throws_exception_if_hash_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $hash = Hash::fromString('inv@lid');
    }
}