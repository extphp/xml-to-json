<?php
/**
 * Used the code from this comment: https://www.php.net/manual/en/class.simplexmlelement.php#122006
 */
namespace ExtPHP\XmlToJson;

class XmlToJsonConverter
{

    protected $attributesKey    = '_attributes';
    protected $valueKey         = '_value';

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    public function toArray()
    {
        $parser = function (\SimpleXMLElement $xml, array $collection = []) use (&$parser) {
            $nodes = $xml->children();
            $attributes = $xml->attributes();

            if (0 !== count($attributes)) {
                foreach ($attributes as $attrName => $attrValue) {
                    $collection[$this->attributesKey][$attrName] = strval($attrValue);
                }
            }

            if (0 === $nodes->count()) {
                $collection[$this->valueKey] = strval($xml);
                return $collection;
            }

            foreach ($nodes as $nodeName => $nodeValue) {
                if (count($nodeValue->xpath('../' . $nodeName)) < 2) {
                    $collection[$nodeName] = $parser($nodeValue);
                    continue;
                }

                $collection[$nodeName][] = $parser($nodeValue);
            }

            return $collection;
        };

        return [
            $this->xml->getName() => $parser($this->xml)
        ];
    }

    public function toJson(int $options = 0, int $depth = 512)
    {
        return json_encode($this->toArray(), $options, $depth);
    }

    public function setAttributesKey($key = '')
    {
        $this->attributesKey = $key;
    }

    public function setValueKey($key = '')
    {
        $this->valueKey = $key;
    }
}
