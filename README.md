# XML to JSON

[![Build Status](https://travis-ci.org/extphp/xml-to-json.svg?branch=master)](https://travis-ci.org/extphp/xml-to-json)
[![Latest Stable Version](https://poser.pugx.org/extphp/xml-to-json/v/stable)](https://packagist.org/packages/extphp/xml-to-json)
[![License](https://poser.pugx.org/extphp/xml-to-json/license)](https://packagist.org/packages/extphp/xml-to-json)
[![Total Downloads](https://poser.pugx.org/extphp/xml-to-json/downloads)](https://packagist.org/packages/extphp/xml-to-json)


An XML to JSON converter that will properly preserve attributes.

## Installation

`composer require extphp/xml-to-json`

## Usage

A generic usage, usefull when the `SimpleXMLElement` instance already exists.

```php
use ExtPHP\XmlToJson\XmlToJsonConverter;

$string = '<node attr1="value1" attr2="value2"><child>child value</child></node>';
$xml = simplexml_load_string($string);

$converter = new XmlToJsonConverter($xml);
$converter->toArray();      // convert xml to array
$converter->toJson();       // convert xml to json
```

A quick approach when you need to convert a XML string to array or json.

```php
use ExtPHP\XmlToJson\JsonableXML;

$xml = new JsonableXML('<node attr1="value1" attr2="value2"><child>child value</child></node>');
json_encode($xml);      // convert xml to json

// These methods are also available directly on the xml object.
$xml->toArray();        // convert xml to array
$xml->toJson();         // convert xml to json
```
