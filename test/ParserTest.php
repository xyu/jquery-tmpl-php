<?php

require_once 'jQueryTmpl.php';

class jQueryTmpl_ParserTest extends PHPUnit_Framework_TestCase
{
    private $_cut;

    public function setUp()
    {
        $elementFactory = $this->getMock('jQueryTmpl_Element_Factory', array('createBlock','createControl','createInline'));
        $elementFactory
            ->expects($this->any())
            ->method('createBlock')
            ->will($this->returnCallback('jQueryTmpl_ParserTest__FactoryBlockCallback'));
        $elementFactory
            ->expects($this->any())
            ->method('createControl')
            ->will($this->returnCallback('jQueryTmpl_ParserTest__FactoryControlCallback'));
        $elementFactory
            ->expects($this->any())
            ->method('createInline')
            ->will($this->returnCallback('jQueryTmpl_ParserTest__FactoryInlineCallback'));

        $this->_cut = new jQueryTmpl_Parser($elementFactory);
    }

    public function testShouldCreatInlineElements()
    {
        $elements = $this->_cut->parse
        (
            array
            (
                new jQueryTmpl_Token_NoOp(0, array(), 'a'),
                new jQueryTmpl_Token_Comment(0, array(), 'b'),
                new jQueryTmpl_Token_NoOp(0, array(), 'c'),
                new jQueryTmpl_Token_ValueEscaped(0, array(), 'd')
            )
        );

        $this->assertEquals
        (
            array
            (
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_NoOp',
                    new jQueryTmpl_Token_NoOp(0, array(), 'a')
                ),
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_Comment',
                    new jQueryTmpl_Token_Comment(0, array(), 'b')
                ),
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_NoOp',
                    new jQueryTmpl_Token_NoOp(0, array(), 'c')
                ),
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_ValueEscaped',
                    new jQueryTmpl_Token_ValueEscaped(0, array(), 'd')
                )
            ),
            $elements
        );
    }

    public function testShouldCreatNestedElements()
    {
        $elements = $this->_cut->parse
        (
            array
            (
                new jQueryTmpl_Token_NoOp(0, array(), 'a'),
                new jQueryTmpl_Token_Comment(0, array(), 'b'),
                new jQueryTmpl_Token_IfStart(0, array(), 'c1'),
                new jQueryTmpl_Token_NoOp(1, array(), 'c2'),
                new jQueryTmpl_Token_Else(0, array(), 'c3'),
                new jQueryTmpl_Token_ValueEscaped(1, array(), 'c4'),
                new jQueryTmpl_Token_IfEnd(0, array(), 'c5'),
                new jQueryTmpl_Token_ValueEscaped(0, array(), 'd')
            )
        );

        $this->assertEquals
        (
            array
            (
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_NoOp',
                    new jQueryTmpl_Token_NoOp(0, array(), 'a')
                ),
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_Comment',
                    new jQueryTmpl_Token_Comment(0, array(), 'b')
                ),
                array
                (
                    'Block',
                    'jQueryTmpl_Token_IfStart',
                    array
                    (
                        new jQueryTmpl_Token_IfStart(0, array(), 'c1'),
                        new jQueryTmpl_Token_NoOp(1, array(), 'c2'),
                        new jQueryTmpl_Token_Else(0, array(), 'c3'),
                        new jQueryTmpl_Token_ValueEscaped(1, array(), 'c4'),
                        new jQueryTmpl_Token_IfEnd(0, array(), 'c5'),
                    )
                ),
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_ValueEscaped',
                    new jQueryTmpl_Token_ValueEscaped(0, array(), 'd')
                )
            ),
            $elements
        );
    }

    public function testShouldCreatControlElements()
    {
        $elements = $this->_cut->parse
        (
            array
            (
                new jQueryTmpl_Token_NoOp(1, array(), 'c2'),
                new jQueryTmpl_Token_Else(0, array(), 'c3'),
                new jQueryTmpl_Token_ValueEscaped(1, array(), 'c4'),
            )
        );

        $this->assertEquals
        (
            array
            (
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_NoOp',
                    new jQueryTmpl_Token_NoOp(1, array(), 'c2')
                ),
                array
                (
                    'Control',
                    'jQueryTmpl_Token_Else',
                    new jQueryTmpl_Token_Else(0, array(), 'c3')
                ),
                array
                (
                    'Inline',
                    'jQueryTmpl_Token_ValueEscaped',
                    new jQueryTmpl_Token_ValueEscaped(1, array(), 'c4')
                )
            ),
            $elements
        );
    }

    /**
     * @expectedException jQueryTmpl_Parser_Exception
     */
    public function testShouldThrowExceptionWithNonMatchedEndBlocks()
    {
        $elements = $this->_cut->parse
        (
            array
            (
                new jQueryTmpl_Token_NoOp(0, array(), 'a'),
                new jQueryTmpl_Token_Comment(0, array(), 'b'),
                new jQueryTmpl_Token_IfEnd(0, array(), 'c1'),
                new jQueryTmpl_Token_NoOp(1, array(), 'c2'),
                new jQueryTmpl_Token_Else(0, array(), 'c3'),
                new jQueryTmpl_Token_ValueEscaped(1, array(), 'c4'),
                new jQueryTmpl_Token_IfStart(0, array(), 'c5'),
                new jQueryTmpl_Token_ValueEscaped(0, array(), 'd')
            )
        );
    }
}

function jQueryTmpl_ParserTest__FactoryBlockCallback()
{
    return array_merge(array('Block'), func_get_args());
}

function jQueryTmpl_ParserTest__FactoryControlCallback()
{
    return array_merge(array('Control'), func_get_args());
}

function jQueryTmpl_ParserTest__FactoryInlineCallback()
{
    return array_merge(array('Inline'), func_get_args());
}

