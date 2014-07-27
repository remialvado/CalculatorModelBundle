<?php

namespace Acme\CalculatorModelBundle\Model;

use JMS\Serializer\Annotation as Serializer;

class Result
{
    /**
     * @var mixed
     * @Serializer\Type("string")
     */
    protected $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
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