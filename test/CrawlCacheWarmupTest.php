<?php

namespace Evista\CrawlCacheWarmup\Test;

use Evista\CrawlCacheWarmup\ServiceContainer;

class CrawlCacheWarmupTest extends \PHPUnit_Framework_TestCase
{
    public function testTest()
    {
        $this->assertEquals(1, 1);
    }

    public function testContainer()
    {
        //curl
        $container = new ServiceContainer();
        $curl = $container->get('crawler');
        $curlReflection = new \ReflectionClass($curl);
        $this->assertEquals('Curl\Curl', $curlReflection->getName());
    }

    public function testCrawlLink()
    {
        //$linkVisitor = new LinkVisitor();
    }
}