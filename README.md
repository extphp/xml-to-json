# XML to JSON

[![Build Status](https://travis-ci.org/extphp/xml-to-json.svg?branch=master)](https://travis-ci.org/extphp/xml-to-json)
[![Latest Stable Version](https://poser.pugx.org/extphp/xml-to-json/v/stable)](https://packagist.org/packages/extphp/xml-to-json)
[![License](https://poser.pugx.org/extphp/xml-to-json/license)](https://packagist.org/packages/extphp/xml-to-json)
[![Total Downloads](https://poser.pugx.org/extphp/xml-to-json/downloads)](https://packagist.org/packages/extphp/xml-to-json)


An XML to JSON converter that will properly preserve attributes.

## Usage

```php
$string = '<node attr1="value1" attr2="value2"><child>child value</child></node>';
$xml = simplexml_load_string($string);

$converter = new XmlToJsonConverter($xml);
$converter->toArray();      // convert xml to array
$converter->toJson();       // convert xml to json
```

## Installation

`composer require extphp/xml-to-json`
