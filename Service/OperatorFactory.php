<?php

namespace Acme\CalculatorModelBundle\Service;

use Acme\CalculatorModelBundle\Model\Operator\Operator;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.operator.factory")
 */
class OperatorFactory
{
    /**
     * @var Operator[]
     */
    protected $operators;

    function __construct($operators = [])
    {
        $this->operators = $operators;
    }

    /**
     * @param string $id
     * @return Operator
     */
    public function getOperator($id)
    {
        if (array_key_exists($id, $this->operators)) {
            return  $this->operators[$id];
        }
        throw new \Exception("Do not support operator '" . $id . "' for the moment");
    }

    /**
     * @return Operator[]
     */
    public function getSupportedOperators()
    {
        return array_values($this->operators);
    }

    /**
     * @param Operator $operator
     */
    public function addOperator($operator)
    {
        $this->operators[$operator->getId()] = $operator;
    }
} 