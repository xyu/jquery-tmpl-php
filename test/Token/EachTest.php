<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_EachTest extends PHPUnit_Framework_TestCase
{
    private $_data;

    public function setUp()
    {
        $json = '
{
    "test1" : "data1",
    "test2" : "data2",
    "array" : ["av1","av2","av3"],
    "object" :
    {
        "person1" :
        {
            "name" : "Sophia",
            "gender" : "F"
        },
        "person2" :
        {
            "name" : "Zack",
            "gender" : "M"
        },
        "person3" :
        {
            "name" : "Zoe",
            "gender" : "F"
        },
        "person4" :
        {
            "name" : "Morgan"
        }
    }
}';

        $this->_data = new jQueryTmpl_Data(json_decode($json));
    }

    public function testShoudLoopThroughArray()
    {
        $template = '
{{each array}}
    <li>{{= $index}}: {{= $value}}</li>
{{/each}}';

        $tokens = array
        (
            $this->_getNoOp('<li>'),
            $this->_getValue('{{= $index}}'),
            $this->_getNoOp(': '),
            $this->_getValue('{{= $value}}'),
            $this->_getNoOp('</li>')
        );

        $tokenizer = $this->getMock('jQueryTmpl_Tokenizer', array('tokenize'));
        $tokenizer
            ->expects($this->once())
            ->method('tokenize')
            ->with($this->equalTo('<li>{{= $index}}: {{= $value}}</li>'))
            ->will($this->returnValue($tokens));

        $cut = new jQueryTmpl_Token_Each($tokenizer);
        $cut->parseString(trim($template));

        $this->assertEquals
        (
            '<li>0: av1</li><li>1: av2</li><li>2: av3</li>',
            $cut->render($this->_data)
        );
    }

    public function testShoudLoopThroughObject()
    {
        $template = '
{{each object}}
    <li id="{{= $index}}">{{= $value.gender}}: {{= this.name}} ({{= test2}})</li>
{{/each}}';

        $tokens = array
        (
            $this->_getNoOp('<li id="'),
            $this->_getValue('{{= $index}}'),
            $this->_getNoOp('">'),
            $this->_getValue('{{= $value.gender}}'),
            $this->_getNoOp(': '),
            $this->_getValue('{{= this.name}}'),
            $this->_getNoOp(' ('),
            $this->_getValue('{{= test2}}'),
            $this->_getNoOp(')</li>')
        );

        $tokenizer = $this->getMock('jQueryTmpl_Tokenizer', array('tokenize'));
        $tokenizer
            ->expects($this->once())
            ->method('tokenize')
            ->with($this->equalTo('<li id="{{= $index}}">{{= $value.gender}}: {{= this.name}} ({{= test2}})</li>'))
            ->will($this->returnValue($tokens));

        $cut = new jQueryTmpl_Token_Each($tokenizer);
        $cut->parseString(trim($template));

        $this->assertEquals
        (
            '<li id="person1">F: Sophia (data2)</li><li id="person2">M: Zack (data2)</li><li id="person3">F: Zoe (data2)</li><li id="person4">: Morgan (data2)</li>',
            $cut->render($this->_data)
        );
    }

    private function _getNoOp($content)
    {
        $return = new jQueryTmpl_Token_NoOp();
        $return->parseString($content);

        return $return;
    }

    private function _getValue($content)
    {
        $return = new jQueryTmpl_Token_ValueEscaped();
        $return->parseString($content);

        return $return;
    }
}

