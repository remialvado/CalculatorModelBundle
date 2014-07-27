<?php

namespace Acme\CalculatorModelBundle\Tests\Model;

use Acme\CalculatorModelBundle\Model\Result;
use Acme\CalculatorModelBundle\Tests\BaseTestCase;

class ResultTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $result = new Result(3);
        $this->assertThat($result->getValue(), $this->equalTo(3));
    }

    /**
     * @test
     */
    public function setValue()
    {
        $result = new Result(3);
        $result->setValue(4);
        $this->assertThat($result->getValue(), $this->equalTo(4));
    }

    /**
     * @test
     */
    public function serializeJson() {
        $result = new Result("3");
        $expected = '{"value":"3"}';
        $this->assertThat($this->getSerializer()->serialize($result, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"value":"3"}';
        $expected = new Result("3");
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorModelBundle\Model\Result", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $result = new Result(3);
        $this->assertThat($this->getSerializer()->serialize($result, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Result(3);
        $this->assertThat($this->getSerializer()->deserialize($this->xmlSerializationFormat, "Acme\CalculatorModelBundle\Model\Result", "xml"), $this->equalTo($expected));
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
  <value><![CDATA[3]]></value>
</result>

EOD;
} 