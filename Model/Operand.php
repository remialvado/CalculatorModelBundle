<?php

namespace Acme\CalculatorModelBundle\Model;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Operand
{
    /**
     * @var double
     * @Serializer\Type("double")
     * @Assert\Type("double")
     * @Assert\NotNull()
     */
    protected $value;

    function __construct($value = null)
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