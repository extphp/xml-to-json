<?php

namespace ExtPHP\XmlToJson;

class JsonableXML extends \SimpleXMLElement implements \JsonSerializable
{
    public function toArray()
    {
        return (new XmlToJsonConverter($this))->toArray();
    }

    public function toJson(int $options = 0, int $depth = 512)
    {
        return (new XmlToJsonConverter($this))->toJson($options, $depth);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
