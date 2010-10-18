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
            return false;
        }

        if (substr($string, -$this->_cTagLen) !== $this->_cTag)
        {
            return false;
        }

        $tagBody = substr($string, $startTagLen, -$this->_cTagLen);

        return (strpos($tagBody,$this->_cTag) === false);
    }
}

