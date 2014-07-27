<?php

namespace Acme\CalculatorModelBundle\Model;

use JMS\Serializer\Annotation as Serializer;

class Operand
{
    /**
     * @var double
     * @Serializer\Type("double")
     */
    protected $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param double $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return double
     */
    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
} 