<?php
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function testSomething()
    {
        $this->assertTrue(true, '没用了吧');
    }

    /**
     * @test
     */
    public function something()
    {
        $this->assertTrue(true, 'This should already work.');
    }
}