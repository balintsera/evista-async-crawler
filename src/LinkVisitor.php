<?php
/**
 * Created by PhpStorm.
 * User: balint
 * Date: 2016. 03. 04.
 * Time: 8:02.
 */

namespace Evista\CrawlCacheWarmup;

use React\Async\Util as Async;
use Evista\CrawlCacheWarmup\Exception\CrawlerException;

class LinkVisitor
{
    private $timeout = 50;
    private $services = false;
    private $lastResult = false;

    public function __construct()
    {
        $this->services = new ServiceContainer();
    }

    public function visit($url)
    {
        // Get crawler service
        $crawler = $this->services->get('crawler');

        // Get url
        $crawler->get($url);
        $this->lastResponse = $crawler->response;
        if ($crawler->error) {
            throw new CrawlerException('Error when trying to get content. Crawler error: '.$crawler->error_message);
        }
    }

    public function visitAll(array $links, $timeout = false)
    {
        $loop = \React\EventLoop\Factory::create();
        if ($timeout) {
            $this->timeout = $timeout;
        }
        $paralellCallbacks = [];
        $timer = 1;
        foreach ($links as $url) {
            $paralellCallbacks[] = function ($callback, $errback) use ($url, $loop) {
                $loop->addTimer(
                    $timer,
                    function () use ($callback, $url) {
                        $callback($url);
                    }
                );
            };
            $timer += $this->timeout;
        }

        Async::parallel(
            $paralellCallbacks,
            function (array $results) {
                foreach ($results as $result) {
                    $this->visit($result);
                }
            },
            function (\Exception $e) {
                throw $e;
            }
        );

        $loop->run();
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }
}
