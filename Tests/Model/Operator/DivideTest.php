<?php

namespace Acme\CalculatorModelBundle\Tests\Model\Operator;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Model\Result;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;
use Acme\CalculatorModelBundle\Model\Operator\Divide;

class DivideTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $divide = new Divide();
        $this->assertThat($divide->getId(), $this->equalTo("divide"));
        $this->assertThat($divide->getLabel(), $this->equalTo("/"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $divide = new Divide();
        $this->assertThat($divide->compute(new Operand(10), new Operand(2)), $this->equalTo(new Result(5)));
    }

    /**
     * @test
     */
    public function dividePositiveByZero()
    {
        $divide = new Divide();
        $this->assertThat($divide->compute(new Operand(10), new Operand(0)), $this->equalTo(new Result("infinity")));
    }

    /**
     * @test
     */
    public function divideNegativeByZero()
    {
        $divide = new Divide();
        $this->assertThat($divide->compute(new Operand(-10), new Operand(0)), $this->equalTo(new Result("-infinity")));
    }

    /**
     * @test
     */
    public function serializeJson() {
        $divide = new Divide();
        $expected = '{"_type":"divide","id":"divide","label":"\/"}';
        $this->assertThat($this->getSerializer()->serialize($divide, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"_type":"divide","id":"divide","label":"\/"}';
        $expected = new Divide();
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorModelBundle\Model\Operator\Operator", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $divide = new Divide();
        $this->assertThat($this->getSerializer()->serialize($divide, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Divide();
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
  <_type><![CDATA[divide]]></_type>
  <id><![CDATA[divide]]></id>
  <label><![CDATA[/]]></label>
  <_type><![CDATA[divide]]></_type>
</result>

EOD;
} 