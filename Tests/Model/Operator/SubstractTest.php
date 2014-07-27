<?php

namespace Acme\CalculatorModelBundle\Tests\Model\Operator;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Model\Operator\Substract;
use Acme\CalculatorModelBundle\Model\Result;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;

class SubstractTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $substract = new Substract();
        $this->assertThat($substract->getId(), $this->equalTo("substract"));
        $this->assertThat($substract->getLabel(), $this->equalTo("-"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $substract = new Substract();
        $this->assertThat($substract->compute(new Operand(2), new Operand(1)), $this->equalTo(new Result(1)));
    }

    /**
     * @test
     */
    public function serializeJson() {
        $substract = new Substract();
        $expected = '{"_type":"substract","id":"substract","label":"-"}';
        $this->assertThat($this->getSerializer()->serialize($substract, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"_type":"substract","id":"substract","label":"-"}';
        $expected = new Substract();
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorModelBundle\Model\Operator\Operator", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $substract = new Substract();
        $this->assertThat($this->getSerializer()->serialize($substract, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Substract();
        $this->assertThat($this->getSerializer()->deserialize($this->xmlSerializationFormat, "Acme\CalculatorModelBundle\Model\Operator\Operator", "xml"), $this->equalTo($expected));
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
  <_type><![CDATA[substract]]></_type>
  <id><![CDATA[substract]]></id>
  <label><![CDATA[-]]></label>
  <_type><![CDATA[substract]]></_type>
</result>

EOD;
} 