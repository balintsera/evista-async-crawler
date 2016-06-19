<?php

namespace Evista\CrawlCacheWarmup\test;

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
        //$result = $linkVisitor->visit('http://127.0.0.1:8181');
        $result = null;
        $this->assertEquals(null, $result);

        $result = $linkVisitor->visit('http://google.hu');
        $this->assertEquals(null, $result);
        $this->assertGreaterThan(1, strlen($linkVisitor->getLastResponse()));
    }

    public function testVisitAll()
    {
        $links = ['http://google.com', 'http://google.hu'];

        $linkVisitor = new LinkVisitor();
        $linkVisitor->visitAll($links);
        $this->assertGreaterThan(1, strlen($linkVisitor->getLastResponse()));
    }
}
