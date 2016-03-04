<?php
/**
 * Created by PhpStorm.
 * User: balint
 * Date: 2016. 03. 04.
 * Time: 8:04
 */

namespace Evista\CrawlCacheWarmup;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;


class ServiceContainer
{
    private $services = [];

    public function __construct()
    {
        $this->services = new ContainerBuilder();
        $this->register();
    }

    public function get($serviceName)
    {
        return $this->services->get($serviceName);
    }

    private function register()
    {
        // Curl
        $this->services->register('crawler', '%crawler.class%');
        $this->services->setParameter('crawler.class', 'Curl\Curl');
    }


}