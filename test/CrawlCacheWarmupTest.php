<?php

namespace Evista\CrawlCacheWarmup\Test;

use Evista\CrawlCacheWarmup\ServiceContainer;
use Evista\CrawlCacheWarmup\LinkVisitor;

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
        $linkVisitor = new LinkVisitor();
        $result = $linkVisitor->visit('http://127.0.0.1:8181');
        $this->assertEquals(true, $result);
    }
}