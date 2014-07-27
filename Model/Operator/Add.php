<?php

namespace Acme\CalculatorModelBundle\Model\Operator;

use Acme\CalculatorModelBundle\Model\Result;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.operator.add")
 * @DI\Tag("acme.calculator.operator")
 */
class Add extends Operator
{
    public function __construct()
    {
        parent::__construct("add", "+");
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     * @return \Acme\CalculatorModelBundle\Model\Result|void
     */
    public function compute($operandA, $operandB)
    {
        return new Result($operandA->getValue() + $operandB->getValue());
    }
} 