<?php

abstract class jQueryTmpl_Token_Base implements jQueryTmpl_Token
{
    protected $_oTag = '{{';
    protected $_oTagLen = 2;
    protected $_cTag = '}}';
    protected $_cTagLen = 2;

    /**
     *  Validates that the string in question contains only one closing
     *  tag and opens with the required tag.
     */
    protected function _validateIsSingleTag($string, $requiredTag)
    {
        $startTagLen = $this->_oTagLen + strlen($requiredTag);

        if (substr($string, 0, $startTagLen) !== $this->_oTag.$requiredTag)
        {
            throw new jQueryTmpl_Token_Exception("Tag must start with '$this->_oTag$requiredTag'.");
        }

        if (substr($string, -$this->_cTagLen) !== $this->_cTag)
        {
            throw new jQueryTmpl_Token_Exception("Tag must end with '$this->_cTag'.");
        }

        $tagBody = substr($string, $startTagLen, -$this->_cTagLen);

        if (strpos($tagBody,$this->_cTag) !== false)
        {
            throw new jQueryTmpl_Token_Exception("Tag can not contain multiple end tags '$this->_cTag'.");
        }
    }
}

