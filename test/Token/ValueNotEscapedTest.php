<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_ValueNotEscapedTest extends PHPUnit_Framework_TestCase
{
    private $_cut;
    private $_data;

    public function setUp()
    {
        $json = <<<EOF
{
    "key1" : "value1",
    "key2" : "value2",
    "htmlKey" : "<span>Some Text & marks \"'\".</span>",
    "_fancyKey" : "value3",
    "\$wtfKey" : "value4"
}
EOF;

        $this->_cut = new jQueryTmpl_Token_ValueNotEscaped();
        $this->_data = new jQueryTmpl_Data(json_decode($json));
    }

    public function testShouldReturnTagReplacedWithValue()
    {
        $this->_cut->parseString('{{html key1 }}');

        $this->assertEquals
        (
            'value1',
            $this->_cut->render($this->_data)
        );
    }

    public function testShouldReturnTagReplacedWithValueWithUncommonKey()
    {
        $this->_cut->parseString('{{html $wtfKey }}');

        $this->assertEquals
        (
            'value4',
            $this->_cut->render($this->_data)
        );
    }

    public function testShouldReturnNonexistantTagReplacedWithEmptyString()
    {
        $this->_cut->parseString('{{html dneKey }}');

        $this->assertEmpty
        (
            $this->_cut->render($this->_data)
        );
    }

    public function testShouldReturnTagReplacedWithHtmlValue()
    {
        $this->_cut->parseString('{{html htmlKey }}');

        $this->assertEquals
        (
            "<span>Some Text & marks \"'\".</span>",
            $this->_cut->render($this->_data)
        );
    }
}

