<?php

namespace Acme\CalculatorModelBundle\Model\Operator;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\Discriminator(field = "_type", map = {
 *      "add": "Acme\CalculatorModelBundle\Model\Operator\Add",
 *      "substract": "Acme\CalculatorModelBundle\Model\Operator\Substract",
 *      "multiply": "Acme\CalculatorModelBundle\Model\Operator\Multiply",
 *      "divide": "Acme\CalculatorModelBundle\Model\Operator\Divide"
 * })
 */
abstract class Operator
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $label;

    function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     * @return \Acme\CalculatorModelBundle\Model\Result mixed
     */
    public abstract function compute($operandA, $operandB);

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("_type")
     */
    public function getType()
    {
        return $this->id;
    }
} 