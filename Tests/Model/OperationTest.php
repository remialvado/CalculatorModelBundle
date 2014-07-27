<?php

namespace Acme\CalculatorModelBundle\Tests\Model;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Model\Operation;
use Acme\CalculatorModelBundle\Model\Operator\Add;
use Acme\CalculatorModelBundle\Model\Result;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;

class OperationTest extends BaseTestCase
{
    /**
     * @test
     */
    public function serializeJson() {
        $operation = new Operation(new Operand(3), new Operand(4), new Add(), new Result("7"));
        $expected = '{"operand_a":{"value":3},"operand_b":{"value":4},"operator":{"_type":"add","id":"add","label":"+"},"result":{"value":"7"}}';
        $this->assertThat($this->getSerializer()->serialize($operation, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"operand_a":{"value":3},"operand_b":{"value":4},"operator":{"_type":"add","id":"add","label":"+"},"result":{"value":"7"}}';
        $expected = new Operation(new Operand(3), new Operand(4), new Add(), new Result("7"));
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorModelBundle\Model\Operation", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $operation = new Operation(new Operand(3), new Operand(4), new Add(), new Result("7"));
        $this->assertThat($this->getSerializer()->serialize($operation, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Operation(new Operand(3), new Operand(4), new Add(), new Result("7"));
        $this->assertThat($this->getSerializer()->deserialize($this->xmlSerializationFormat, "Acme\CalculatorModelBundle\Model\Operation", "xml"), $this->equalTo($expected));
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
  <operand_a>
    <value>3</value>
  </operand_a>
  <operand_b>
    <value>4</value>
  </operand_b>
  <operator>
    <_type><![CDATA[add]]></_type>
    <id><![CDATA[add]]></id>
    <label><![CDATA[+]]></label>
  </operator>
  <result>
    <value><![CDATA[7]]></value>
  </result>
</result>

EOD;
} 