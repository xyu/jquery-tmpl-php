<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_NoOpTest extends PHPUnit_Framework_TestCase
{
    private $_cut;

    public function setUp()
    {
        $this->_cut = new jQueryTmpl_Token_NoOp();
    }

    public function testShouldReturnString()
    {
        $str = 'Some random <strong>string</strong>.';

        $this->_cut->parseString($str);

        $this->assertEquals
        (
            $str,
            $this->_cut->render(new stdClass())
        );
    }
}

