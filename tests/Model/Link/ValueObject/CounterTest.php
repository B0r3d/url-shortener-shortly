<?php


namespace App\Tests\Model\Link\ValueObject;


use App\Model\Link\ValueObject\Counter;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{
    /** @test */
    public function counter_can_be_created()
    {
        $counter = new Counter();

        $this->assertEquals(0, $counter->count());
    }

    /** @test */
    public function counter_can_be_incremented()
    {
        $counter = new Counter();

        $this->assertEquals(0, $counter->count());
        $counter->increment();
        $this->assertEquals(1, $counter->count());
    }
}