<?php

/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2015/11/2
 * Time: 18:06
 */
class FixedPoolTest extends PHPUnit_Framework_TestCase
{
    public function testAll(){
        $pool = new \Jenner\SimpleFork\FixedPool(new FixedPoolTestRunnable(), 10);
        $pool->start();
        $this->assertEquals(10, $pool->aliveCount());
        sleep(4);
        $this->assertEquals(0, $pool->aliveCount());
        $pool->keep();
        $this->assertEquals(10, $pool->count());
        $this->assertEquals(10, $pool->aliveCount());
        $pool->wait(true);
    }

    public function testException(){
        $this->setExpectedException('InvalidArgumentException');
        $pool = new \Jenner\SimpleFork\FixedPool('test');
    }
}


class FixedPoolTestRunnable implements \Jenner\SimpleFork\Runnable {

    /**
     * process entry
     *
     * @return mixed
     */
    public function run()
    {
        sleep(3);
    }
}