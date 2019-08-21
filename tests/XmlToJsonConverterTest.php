<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ExtPHP\XmlToJson\XmlToJsonConverter;

class XmlToJsonConverterTest extends TestCase
{
    /**
     * @dataProvider conversionsDataProvider
     */
    public function testConversions($xmlString, $jsonValue)
    {
        $xml = simplexml_load_string($xmlString);
        $converter = new XmlToJsonConverter($xml);
        $this->assertEquals($jsonValue, $converter->toJson());
    }

    public function conversionsDataProvider()
    {
        return [
            [
                '<node attr1="value1" attr2="value2"><child>child value</child></node>',
                '{"node":{"_attributes":{"attr1":"value1","attr2":"value2"},"child":{"_value":"child value"}}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child>child1 value</child><child>child2 value</child></node>',
                '{"node":{"_attributes":{"attr1":"value1","attr2":"value2"},"child":[{"_value":"child1 value"},{"_value":"child2 value"}]}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child1>child1 value</child1><child2>child2 value</child2></node>',
                '{"node":{"_attributes":{"attr1":"value1","attr2":"value2"},"child1":{"_value":"child1 value"},"child2":{"_value":"child2 value"}}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child attr1="value1">child value</child></node>',
                '{"node":{"_attributes":{"attr1":"value1","attr2":"value2"},"child":{"_attributes":{"attr1":"value1"},"_value":"child value"}}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child attr1="value1">child value</child><child attr1="value2">child value2</child></node>',
                '{"node":{"_attributes":{"attr1":"value1","attr2":"value2"},"child":[{"_attributes":{"attr1":"value1"},"_value":"child value"},{"_attributes":{"attr1":"value2"},"_value":"child value2"}]}}'
            ]
        ];
    }
}
