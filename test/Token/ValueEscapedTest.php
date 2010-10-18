<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_ValueEscapedTest extends PHPUnit_Framework_TestCase
{
    private $_cut;
    private $_data;

    public function setUp()
    {
        $this->_cut = new jQueryTmpl_Token_ValueEscaped();

        $wtfKey = '$wtfKey';
        $this->_data = new stdClass();
        $this->_data->key1 = 'value1';
        $this->_data->key2 = 'value2';
        $this->_data->htmlKey = '<span>Some Text & marks "\'".</span>';
        $this->_data->_fancyKey = 'value3';
        $this->_data->$wtfKey = 'value4';
    }

    public function testShouldReturnTagReplacedWithValue()
    {
        $this->_cut->parseString('{{= key1 }}');

        $this->assertEquals
        (
            'value1',
            $this->_cut->render($this->_data)
        );
    }

    public function testShouldReturnTagReplacedWithValueWithUncommonKey()
    {
        $this->_cut->parseString('{{= $wtfKey }}');

        $this->assertEquals
        (
            'value4',
            $this->_cut->render($this->_data)
        );
    }

    public function testShouldReturnNonexistantTagReplacedWithEmptyString()
    {
        $this->_cut->parseString('{{= dneKey }}');

        $this->assertEmpty
        (
            $this->_cut->render($this->_data)
        );
    }

    public function testShouldReturnTagReplacedWithEscapedValue()
    {
        $this->_cut->parseString('{{= htmlKey }}');

        $this->assertEquals
        (
            "&lt;span&gt;Some Text &amp; marks &quot;'&quot;.&lt;/span&gt;",
            $this->_cut->render($this->_data)
        );
    }
}

