<?php
/**
 * Created by PhpStorm.
 * User: balint
 * Date: 2016. 03. 04.
 * Time: 8:04.
 */

namespace Evista\CrawlCacheWarmup;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Dependency injection service container.
 *
 * @author Balint Sera <balint.sera@gmail.com>
 */
class ServiceContainer
{
    private $services = [];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->services = new ContainerBuilder();
        $this->register();
    }

    /**
     * Get Service.
     *
     * @param string $serviceName name of the service
     *
     * @return object service  
     */
    public function get($serviceName)
    {
        return $this->services->get($serviceName);
    }

    /**
     * Register services
     * Register your services here, see Symfony Depency Injection component
     * from more info.
     */
    private function register()
    {
        // Curl
        $this->services->register('crawler', '%crawler.class%');
        $this->services->setParameter('crawler.class', 'Curl\Curl');
    }
}
