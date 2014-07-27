<?php

namespace Acme\CalculatorModelBundle\Tests\Model;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;

class OperandTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $operand = new Operand(3);
        $this->assertThat($operand->getValue(), $this->equalTo(3));
    }

    /**
     * @test
     */
    public function setValue()
    {
        $operand = new Operand(3);
        $operand->setValue(4);
        $this->assertThat($operand->getValue(), $this->equalTo(4));
    }

    /**
     * @test
     */
    public function serializeJson() {
        $operand = new Operand(3);
        $expected = '{"value":3}';
        $this->assertThat($this->getSerializer()->serialize($operand, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"value":3}';
        $expected = new Operand(3);
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorModelBundle\Model\Operand", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $operand = new Operand(3);
        $this->assertThat($this->getSerializer()->serialize($operand, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Operand(3);
        $this->assertThat($this->getSerializer()->deserialize($this->xmlSerializationFormat, "Acme\CalculatorModelBundle\Model\Operand", "xml"), $this->equalTo($expected));
    }

    /**
     * @return \JMS\Serializer\SerializerInterface
     */
    protected function getSerializer()
    {
        return $this->getService("serializer");
    }

    protected $xmlSerializationFormat = <<<'EOD'
<?xml version="1.0" encoding="UTF-8"?>
<result>
  <value>3</value>
</result>

EOD;
} 