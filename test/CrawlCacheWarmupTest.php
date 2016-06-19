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
        $result = null;
        $this->assertEquals(null, $result);

        $result = $linkVisitor->visit('http://google.hu');
        $this->assertGreaterThan(1, strlen($linkVisitor->getLastResponse()));
    }

    public function testFailedCrawler()
    {
        $linkVisitor = new LinkVisitor();

        try {
            $result = $linkVisitor->visit('wronggggurl46');
            $this->fail('Expected exception not thrown');
        } catch (\Evista\CrawlCacheWarmup\Exception\CrawlerException $e) {
            $this->assertEquals(
                'Error when trying to get content. Crawler error: Could not resolve host: wronggggurl46',
                $e->getMessage()
            );
        } catch (\Exception $e) {
            $this->fail('Unexpected exception thrown');
        }
    }

    public function testVisitAll()
    {
        $links = ['http://google.com', 'http://google.hu'];

        $linkVisitor = new LinkVisitor();
        $linkVisitor->visitAll($links);
        $this->assertGreaterThan(1, strlen($linkVisitor->getLastResponse()));
    }
}
