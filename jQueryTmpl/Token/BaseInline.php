<?php

abstract class jQueryTmpl_Token_BaseInline extends jQueryTmpl_Token_Base
{
    /**
     *  Validates that the string in question contains only one closing
     *  tag and opens with the required tag.
     */
    protected function _validateIsSingleTag($string, $startTag)
    {
        if (substr($string, 0, $this->_getStartTagLen($startTag)) !== $this->_oTag.$startTag)
        {
            throw new jQueryTmpl_Token_Exception("Tag must start with '$this->_oTag$startTag'.");
        }

        if (substr($string, -$this->_cTagLen) !== $this->_cTag)
        {
            throw new jQueryTmpl_Token_Exception("Tag must end with '$this->_cTag'.");
        }

        if (strpos($this->_getTagContent($string, $startTag), $this->_cTag) !== false)
        {
            throw new jQueryTmpl_Token_Exception("Tag can not contain multiple end tags '$this->_cTag'.");
        }
    }

    protected function _validateIsNotExpression($string, $startTag)
    {
        if (preg_match('/^[a-z_$][0-9a-z_$]*$/i', $this->_getTagContent($string, $startTag)) == 0)
        {
            throw new jQueryTmpl_Token_Exception("Was not expecting an expression for tag '$string'.");
        }
    }

    protected function _getTagContent($string, $startTag)
    {
        return trim
        (
            substr
            (
                $string,
                $this->_getStartTagLen($startTag),
                -$this->_cTagLen
            )
        );
    }

    private function _getStartTagLen($startTag)
    {
        return $this->_oTagLen + strlen($startTag);
    }
}

