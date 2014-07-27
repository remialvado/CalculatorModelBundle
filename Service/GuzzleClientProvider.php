<?php

namespace Acme\CalculatorModelBundle\Service;

use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.internal.guzzle.provider")
 */
class GuzzleClientProvider {

    protected $plugins = [];

    protected $defaultTimeout;

    public function getClient($baseUrl = null, $config = array())
    {
        $config = $this->enhanceConfiguration($config);
        $client = new Client($baseUrl, $config);
        foreach($this->plugins as $plugin) {
            $client->addSubscriber($plugin);
        }
        return $client;
    }

    public function enhanceConfiguration($config)
    {
        if (!is_array($config)) $config = array();
        if (!array_key_exists("curl.options", $config)) $config["curl.options"] = array();
        if (!array_key_exists(CURLOPT_TIMEOUT, $config["curl.options"])) $config["curl.options"][CURLOPT_TIMEOUT] = $this->defaultTimeout;
        return $config;
    }

    public function __construct($defaultTimeout = 2)
    {
        $this->defaultTimeout = $defaultTimeout;
    }

    public function addPlugin($plugin)
    {
        $this->plugins[] = $plugin;
    }
} 