<?php

namespace Acme\CalculatorModelBundle\Tests\Model;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Model\Operation;
use Acme\CalculatorModelBundle\Model\Operator\Add;
use Acme\CalculatorModelBundle\Model\Operator\Operator;
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
        $mock->addResponse(new Response(200, [], '{"value":"7"}'));
        $guzzleClientProvider = $this->getGuzzleClientProvider();
        $guzzleClientProvider->addPlugin($mock);

        $calculatorServiceClient = new CalculatorServiceClient();
        $calculatorServiceClient->guzzleClientProvider = $guzzleClientProvider;
        $calculatorServiceClient->serializer = $this->getService("serializer");

        $result = $calculatorServiceClient->compute(new Operand(3), new Operand(4), new Add());
        $this->assertThat($result, $this->isInstanceOf("Acme\CalculatorModelBundle\Model\Result"));
        $this->assertThat($result->getValue(), $this->equalTo("7"));
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

        $operation = $calculatorServiceClient->compute(new Operand(3), new Operand(4), new Modulo());
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

class Modulo extends Operator {
    public function __construct()
    {
        parent::__construct("modulo", "%");
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     * @return \Acme\CalculatorModelBundle\Model\Result|void
     */
    public function compute($operandA, $operandB)
    {
        return new Result($operandA->getValue() % $operandB->getValue());
    }
}