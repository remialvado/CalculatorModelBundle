<?php

namespace Acme\CalculatorModelBundle\Tests\Model\Operator;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Model\Operator\Add;
use Acme\CalculatorModelBundle\Model\Result;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;

class AddTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $add = new Add();
        $this->assertThat($add->getId(), $this->equalTo("add"));
        $this->assertThat($add->getLabel(), $this->equalTo("+"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $add = new Add();
        $this->assertThat($add->compute(new Operand(1), new Operand(2)), $this->equalTo(new Result(3)));
    }

    /**
     * @test
     */
    public function serializeJson() {
        $add = new Add();
        $expected = '{"_type":"add","id":"add","label":"+"}';
        $this->assertThat($this->getSerializer()->serialize($add, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"_type":"add","id":"add","label":"+"}';
        $expected = new Add();
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorModelBundle\Model\Operator\Operator", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $add = new Add();
        $this->assertThat($this->getSerializer()->serialize($add, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Add();
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
  <_type><![CDATA[add]]></_type>
  <id><![CDATA[add]]></id>
  <label><![CDATA[+]]></label>
  <_type><![CDATA[add]]></_type>
</result>

EOD;
} 