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
        $this->registerAll();
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
     * Register all services
     * Register your services here, see Symfony Depency Injection component
     * for more info.
     */
    private function registerAll()
    {
        // Register curl as 'crawler'
        $this->registerCurl($curlOptions);
    }

    /**
     * Register curl as crawler service.
     */
    private function registerCurl()
    {
        // Curl options
        $curlOptions = [
            [CURLOPT_RETURNTRANSFER, true],
            [CURLOPT_FOLLOWLOCATION, true],
            [CURLOPT_MAXREDIRS, 2],
            [CURLOPT_HTTPAUTH, CURLAUTH_BASIC],
            [CURLOPT_SSLVERSION, 6],
            [CURLOPT_SSL_VERIFYPEER, false],
            [CURLOPT_SSL_VERIFYHOST, false],
        ];

        // Register service via dependency injection
        $service = $this->services->register('crawler', '%crawler.class%');

        // Set options via setopt
        array_walk(
            $curlOptions,
            function (array $params) use ($service) {
                $service->addMethodCall('setopt', $params);
            }
        );

        $this->services->setParameter('crawler.class', 'Curl\Curl');
    }
}
