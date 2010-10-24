<?php

require_once 'jQueryTmpl.php';

abstract class jQueryTmpl_Element_TestCase extends PHPUnit_Framework_TestCase
{
    protected $_data;
    protected $_elementFactory;

    public function setUp()
    {
        $testData = <<<EOF
{
    "key1" : 123.45,
    "key2" : "a string",
    "key3" : true,
    "key4" : ["item1", "item2", "item3"],
    "key5" :
    {
        "child1" : 543.21,
        "child2" : "another string",
        "child3" : false,
        "child4" : ["item4", "item5", "item6"],
        "child5" :
        {
            "Grand Child 1" : "Rachel",
            "Grand Child 2" : "Naomi",
            "Grand Child 3" : "Cathey"
        }
    }
}
EOF;

        $this->_data = new jQueryTmpl_Data(json_decode($testData));

        $this->_elementFactory = new jQueryTmpl_Element_Factory();
    }
}

