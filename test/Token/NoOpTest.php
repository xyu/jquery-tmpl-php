<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_NoOpTest extends PHPUnit_Framework_TestCase
{
    private $_cut;
    private $_data;

    public function setUp()
    {
        $json = <<<EOF
{
    "test" : "data",
    "sample" : "text"
}
EOF;

        $this->_cut = new jQueryTmpl_Token_NoOp();
        $this->_data = new jQueryTmpl_Data(json_decode($json));
    }

    public function testShouldReturnString()
    {
        $str = 'Some random <strong>string</strong>.';

        $this->_cut->parseString($str);

        $this->assertEquals
        (
            $str,
            $this->_cut->render($this->_data)
        );
    }
}

