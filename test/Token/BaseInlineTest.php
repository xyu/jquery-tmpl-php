<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_BaseInlineTest extends PHPUnit_Framework_TestCase
{
    private $_cut;

    public function setUp()
    {
        $this->_cut = new jQueryTmpl_Token_BaseInlineTest__jQueryTmpl_Token_BaseInline();
    }

    public function testShouldValidateSingleTag()
    {
        $this->_cut->rawTmpl = '{{TEST Some tag options}}';
        $this->assertTrue
        (
            $this->_cut->validateIsSingleTag()
        );

        $this->_cut->rawTmpl = '{{TESTSome tag options}}';
        $this->assertTrue
        (
            $this->_cut->validateIsSingleTag()
        );
    }

    public function testShouldNotValidateWithInvalidStartTag()
    {
        $this->_cut->rawTmpl = '{TEST Some tag options}}';
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag()
        );

        $this->_cut->rawTmpl = '{{Some tag options}}';
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag()
        );
    }

    public function testShouldNotValidateWithNoEndTag()
    {
        $this->_cut->rawTmpl = '{{TEST Some tag options}';
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag()
        );
    }

    public function testShouldNotValidateWithMultipleEndTags()
    {
        $this->_cut->rawTmpl = '{{TEST Some tag options }} with 2 end tags}}';
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag()
        );

        $this->_cut->rawTmpl = '{{TEST Some tag options }}}}';
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag()
        );

        $this->_cut->rawTmpl = '{{TEST Some tag options }}}';
        $this->assertFalse
        (
            $this->_cut->validateIsSingleTag()
        );

        $this->_cut->rawTmpl = '{{TEST Some tag options }}';
        $this->assertTrue
        (
            $this->_cut->validateIsSingleTag()
        );
    }

    public function testShouldConsiderValidVarNameNotExpression()
    {
        $this->_cut->rawTmpl = '{{TESTsomeVarName}}';
        $this->_cut->validateIsNotExpression();

        $this->_cut->rawTmpl = '{{TEST someVarName }}';
        $this->_cut->validateIsNotExpression();

        $this->_cut->rawTmpl = '{{TEST _someVarName }}';
        $this->_cut->validateIsNotExpression();

        $this->_cut->rawTmpl = '{{TEST $someVarName }}';
        $this->_cut->validateIsNotExpression();
    }

    /**
     * @expectedException jQueryTmpl_Token_Exception
     */
    public function testShouldThrowExceptionWhenGivenExpression()
    {
        $this->_cut->rawTmpl = '{{TEST someVarName.length }}';
        $this->_cut->validateIsNotExpression();
    }
}

class jQueryTmpl_Token_BaseInlineTest__jQueryTmpl_Token_BaseInline extends jQueryTmpl_Token_BaseInline
{
    public $rawTmpl;

    public function parseString($str)
    {
    }

    public function render(jQueryTmpl_Data $data)
    {
    }

    public function validateIsSingleTag()
    {
        try
        {
            $this->_validateIsSingleTag();
        }
        catch (jQueryTmpl_Token_Exception $e)
        {
            return false;
        }

        return true;
    }

    public function validateIsNotExpression()
    {
        $this->_validateIsNotExpression();
    }

    protected function _getRawTmpl()
    {
        return $this->rawTmpl;
    }

    protected function _getTag()
    {
        return 'TEST';
    }
}

