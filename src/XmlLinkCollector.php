<?php
/**
 * Created by PhpStorm.
 * User: balint
 * Date: 2016. 03. 04.
 * Time: 9:02.
 */

namespace Evista\CrawlCacheWarmup;

class XmlLinkCollector
{
    private $xml = '';
    /**
     * @param string $xml
     */
    public function construct($xml)
    {
        $this->xml = $xml;
    }

    public function collectURLs()
    {
    }
}
