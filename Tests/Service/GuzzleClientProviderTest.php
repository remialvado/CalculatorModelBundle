<?php

namespace Acme\CalculatorModelBundle\Tests\Model;

use Acme\CalculatorModelBundle\Tests\BaseTestCase;

class GuzzleClientProviderTest extends BaseTestCase
{

    /**
     * @test
     */
    public function addTimeout()
    {
        $guzzleClientProvider = $this->getGuzzleClientProvider();
        $client = $guzzleClientProvider->getClient();
        $config = $client->getConfig(false);
        $this->assertThat($config["curl.options"][CURLOPT_TIMEOUT], $this->equalTo(2));
    }

    /**
     * @return \Acme\CalculatorModelBundle\Service\GuzzleClientProvider
     */
    protected function getGuzzleClientProvider()
    {
        return $this->getService("acme.internal.guzzle.provider");
    }

}