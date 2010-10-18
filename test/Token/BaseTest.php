<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_BaseTest extends PHPUnit_Framework_TestCase
{
    private $_cut;

    public function setUp()
    {
        $this->_cut = new Test_jQueryTmpl_Token_Base();
    }

    public function testShouldValidateSingleTag()
    {
        $this->assertTrue
        (
            $this->_cut->validateIsSingleTag('{{Pure open and close}}', '')
        );

        $this->assertTrue
        (
            $this->_cut->validateIsSingleTag('{{WITH Tag}}', 'WITH')
        );
    }

    public function testShouldNotValidateWithNoStartTag()
    {
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag('{Pure open and close}}', '')
        );

        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag('{WITH Tag}}', 'WITH')
        );

        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag('{{Tag}}', 'WITH')
        );
    }

    public function testShouldNotValidateWithNoEndTag()
    {
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag('{{Pure open and close}', '')
        );
    }

    public function testShouldNotValidateWithMultipleEndTags()
    {
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag('{{Pure open and close}} with second}}', '')
        );
    }
}

class Test_jQueryTmpl_Token_Base extends jQueryTmpl_Token_Base
{
    public function parseString($str)
    {
    }

    public function render(stdClass $data)
    {
    }

    public function validateIsSingleTag($string, $requiredTag)
    {
        return $this->_validateIsSingleTag($string, $requiredTag);
    }
}
