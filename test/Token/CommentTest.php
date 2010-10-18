<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_CommentTest extends PHPUnit_Framework_TestCase
{
    private $_cut;

    public function setUp()
    {
        $this->_cut = new jQueryTmpl_Token_Comment();
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
            $this->_cut->render(new stdClass())
        );
    }
}

