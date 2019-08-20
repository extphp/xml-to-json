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
                '{"node":{"attributes":{"attr1":"value1","attr2":"value2"},"child":{"value":"child value"}}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child>child1 value</child><child>child2 value</child></node>',
                '{"node":{"attributes":{"attr1":"value1","attr2":"value2"},"child":[{"value":"child1 value"},{"value":"child2 value"}]}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child1>child1 value</child1><child2>child2 value</child2></node>',
                '{"node":{"attributes":{"attr1":"value1","attr2":"value2"},"child1":{"value":"child1 value"},"child2":{"value":"child2 value"}}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child attr1="value1">child value</child></node>',
                '{"node":{"attributes":{"attr1":"value1","attr2":"value2"},"child":{"attributes":{"attr1":"value1"},"value":"child value"}}}'
            ],
            [
                '<node attr1="value1" attr2="value2"><child attr1="value1">child value</child><child attr1="value2">child value2</child></node>',
                '{"node":{"attributes":{"attr1":"value1","attr2":"value2"},"child":[{"attributes":{"attr1":"value1"},"value":"child value"},{"attributes":{"attr1":"value2"},"value":"child value2"}]}}'
            ]
        ];
    }
}
