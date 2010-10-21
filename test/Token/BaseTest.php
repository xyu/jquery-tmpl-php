<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_Token_BaseTest extends PHPUnit_Framework_TestCase
{
    private $_cut;

    public function setUp()
    {
        $this->_cut = new jQueryTmpl_Token_BaseTest__jQueryTmpl_Token_Base();
    }

    public function testShouldGetTagOptions()
    {
        $this->_cut->rawTmpl = '{{TEST SomeTag }}';
        $this->assertEquals
        (
            'SomeTag',
            $this->_cut->getTagOptions()
        );

        $this->_cut->rawTmpl = '{{TESTSomeTag}}';
        $this->assertEquals
        (
            'SomeTag',
            $this->_cut->getTagOptions()
        );
    }
}

class jQueryTmpl_Token_BaseTest__jQueryTmpl_Token_Base extends jQueryTmpl_Token_Base
{
    public $rawTmpl;

    public function parseString($str)
    {
    }

    public function render(jQueryTmpl_Data $data)
    {
    }

    public function getTagOptions()
    {
        return $this->_getTagOptions();
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

