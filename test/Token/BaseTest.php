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

    public function testShouldConsiderValidVarNameNotExpression()
    {
        $this->_cut->validateIsNotExpression('{{TESTsomeVarName}}', 'TEST');
        $this->_cut->validateIsNotExpression('{{TEST someVarName }}', 'TEST');
        $this->_cut->validateIsNotExpression('{{TEST _someVarName }}', 'TEST');
        $this->_cut->validateIsNotExpression('{{TEST $someVarName }}', 'TEST');
    }

    /**
     * @expectedException jQueryTmpl_Token_Exception
     */
    public function testShouldThrowExceptionWhenGivenExpression()
    {
        $this->_cut->validateIsNotExpression('{{TEST someVarName.length }}', 'TEST');
    }

    public function testShouldGetTagContent()
    {
        $this->assertEquals
        (
            'SomeTag',
            $this->_cut->getTagContent('{{TEST SomeTag }}', 'TEST')
        );

        $this->assertEquals
        (
            'SomeTag',
            $this->_cut->getTagContent('{{TESTSomeTag}}', 'TEST')
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
        try
        {
            $this->_validateIsSingleTag($string, $requiredTag);
        }
        catch (jQueryTmpl_Token_Exception $e)
        {
            return false;
        }

        return true;
    }

    public function validateIsNotExpression($string, $startTag)
    {
        $this->_validateIsNotExpression($string, $startTag);
    }

    public function getTagContent($string, $startTag)
    {
        return $this->_getTagContent($string, $startTag);
    }
}

