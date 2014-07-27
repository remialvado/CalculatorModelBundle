<?php

namespace Acme\CalculatorModelBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.model.service.client")
 */
class CalculatorServiceClient
{
    /**
     * @param string $operandA
     * @param string $operandB
     * @param string $operator
     * @return \Acme\CalculatorModelBundle\Model\Operation
     */
    public function compute($operandA, $operandB, $operator)
    {
        $client = $this->guzzleClientProvider->getClient($this->endpoint . $this->uriPattern, [
                "operandA" => $operandA,
                "operandB" => $operandB,
                "operator" => $operator
        ]);
        $request = $client->get();
        try {
            $response = $request->send();
            if ($response->getStatusCode() === 200) {
                return $this->serializer->deserialize($response->getBody(true), "Acme\CalculatorModelBundle\Model\Operation", "json");
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