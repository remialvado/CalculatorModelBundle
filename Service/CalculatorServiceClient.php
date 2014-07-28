<?php

namespace Acme\CalculatorModelBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.model.service.client")
 */
class CalculatorServiceClient
{
    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     * @param \Acme\CalculatorModelBundle\Model\Operator\Operator $operator
     * @return \Acme\CalculatorModelBundle\Model\Result
     */
    public function compute($operandA, $operandB, $operator)
    {
        $client = $this->guzzleClientProvider->getClient($this->endpoint . $this->uriPattern, [
                "operandA" => $operandA->getValue(),
                "operandB" => $operandB->getValue(),
                "operator" => $operator->getId()
        ]);
        $request = $client->get();
        try {
            $response = $request->send();
            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getBody(true), "Acme\CalculatorModelBundle\Model\Result", "json");
            }
        }
        catch(\Exception $e){}
        return null;
    }

    /**
     * @DI\Inject("acme.internal.guzzle.provider")
     * @var \Acme\CalculatorModelBundle\Service\GuzzleClientProvider
     */
    public $guzzleClientProvider;

    /**
     * @var \JMS\Serializer\SerializerInterface
     * @DI\Inject("serializer")
     */
    public $serializer;

    /**
     * @var string
     * @DI\Inject("%acme.calculator.api.endpoint%")
     */
    public $endpoint;

    protected $uriPattern = "/api/v1/{operandA}/{operandB}/{operator}.json";
} 