<?php

abstract class jQueryTmpl_Token_BaseInline extends jQueryTmpl_Token_Base
{
    /**
     *  Validates that the tag in question contains only one closing
     *  tag and opens with the required tag.
     */
    protected function _validateIsSingleTag()
    {
        if (substr($this->_getRawTmpl(), 0, $this->_getStartTagLen()) !== "{$this->_oTag}{$this->_getTag()}")
        {
            throw new jQueryTmpl_Token_Exception("Tag must start with '{$this->_oTag}{$this->_getTag()}'.");
        }

        if (substr($this->_getRawTmpl(), -$this->_cTagLen) !== $this->_cTag)
        {
            throw new jQueryTmpl_Token_Exception("Tag must end with '$this->_cTag'.");
        }

        if (strpos($this->_getRawTmpl(), $this->_cTag) < strlen($this->_getRawTmpl())-$this->_cTagLen)
        {
            throw new jQueryTmpl_Token_Exception("Tag can not contain multiple end tags '$this->_cTag'.");
        }
    }
}

