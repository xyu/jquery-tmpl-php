<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_ValueNotEscapedTest extends PHPUnit_Framework_TestCase
{
    private $_cut;
    private $_data;

    public function setUp()
    {
        $this->_cut = new jQueryTmpl_Token_ValueNotEscaped();

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
            $this->_data->htmlKey,
            $this->_cut->render($this->_data)
        );
    }
}

