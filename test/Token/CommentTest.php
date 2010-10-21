<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_CommentTest extends PHPUnit_Framework_TestCase
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

        $this->_cut = new jQueryTmpl_Token_Comment();
        $this->_data = new jQueryTmpl_Data(json_decode($json));
    }

    /**
     * @expectedException jQueryTmpl_Token_Exception
     */
    public function testShouldThrowExceptionWithInvalidComment()
    {
        $this->_cut->parseString('{{Not a comment}}');
    }

    public function testShouldReturnEmptyStringForComments()
    {
        $this->_cut->parseString('{{!A comment}}');

        $this->assertEquals
        (
            '',
            $this->_cut->render($this->_data)
        );
    }
}

