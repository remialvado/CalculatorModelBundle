<?php

namespace Acme\CalculatorModelBundle\Tests\Model;

use Acme\CalculatorModelBundle\Service\CalculatorServiceClient;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;

class CalculatorServiceClientTest extends BaseTestCase
{

    /**
     * @test
     */
    public function callWithSuccess()
    {
        $mock = new MockPlugin();
        $mock->addResponse(new Response(200, [], '{"operand_a":{"value":3},"operand_b":{"value":4},"operator":{"_type":"add","id":"add","label":"+"},"result":{"value":"7"}}'));
        $guzzleClientProvider = $this->getGuzzleClientProvider();
        $guzzleClientProvider->addPlugin($mock);

        $calculatorServiceClient = new CalculatorServiceClient();
        $calculatorServiceClient->guzzleClientProvider = $guzzleClientProvider;
        $calculatorServiceClient->serializer = $this->getService("serializer");

        $operation = $calculatorServiceClient->compute(3, 4, "add");
        $this->assertThat($operation, $this->isInstanceOf("Acme\CalculatorModelBundle\Model\Operation"));
        $this->assertThat($operation->getResult(), $this->equalTo("7"));
    }

    /**
     * @test
     */
    public function callWithError()
    {
        $mock = new MockPlugin();
        $mock->addResponse(new Response(500, [], 'Unsupported operator'));
        $guzzleClientProvider = $this->getGuzzleClientProvider();
        $guzzleClientProvider->addPlugin($mock);

        $calculatorServiceClient = new CalculatorServiceClient();
        $calculatorServiceClient->guzzleClientProvider = $guzzleClientProvider;
        $calculatorServiceClient->serializer = $this->getService("serializer");

        $operation = $calculatorServiceClient->compute(3, 4, "modulo");
        $this->assertThat($operation, $this->isNull());
    }

    /**
     * @return \Acme\CalculatorModelBundle\Service\GuzzleClientProvider
     */
    protected function getGuzzleClientProvider()
    {
        return $this->getService("acme.internal.guzzle.provider");
    }

}