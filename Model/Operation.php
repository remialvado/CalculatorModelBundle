<?php

namespace Acme\CalculatorModelBundle\Model;

use JMS\Serializer\Annotation as Serializer;

class Operation
{
    /**
     * @var \Acme\CalculatorModelBundle\Model\Operand
     * @Serializer\Type("Acme\CalculatorModelBundle\Model\Operand")
     */
    protected $operandA;

    /**
     * @var \Acme\CalculatorModelBundle\Model\Operand
     * @Serializer\Type("Acme\CalculatorModelBundle\Model\Operand")
     */
    protected $operandB;

    /**
     * @var \Acme\CalculatorModelBundle\Model\Operator\Operator
     * @Serializer\Type("Acme\CalculatorModelBundle\Model\Operator\Operator")
     */
    protected $operator;

    /**
     * @var \Acme\CalculatorModelBundle\Model\Result
     * @Serializer\Type("Acme\CalculatorModelBundle\Model\Result")
     */
    protected $result;

    function __construct($operandA = null, $operandB = null, $operator = null, $result = null)
    {
        $this->operandA = $operandA;
        $this->operandB = $operandB;
        $this->operator = $operator;
        $this->result = $result;
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     */
    public function setOperandA($operandA)
    {
        $this->operandA = $operandA;
    }

    /**
     * @return \Acme\CalculatorModelBundle\Model\Operand
     */
    public function getOperandA()
    {
        return $this->operandA;
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     */
    public function setOperandB($operandB)
    {
        $this->operandB = $operandB;
    }

    /**
     * @return \Acme\CalculatorModelBundle\Model\Operand
     */
    public function getOperandB()
    {
        return $this->operandB;
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operator\Operator $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return \Acme\CalculatorModelBundle\Model\Operator\Operator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Result $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return \Acme\CalculatorModelBundle\Model\Result
     */
    public function getResult()
    {
        return $this->result;
    }
} 