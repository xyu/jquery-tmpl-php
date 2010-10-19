<?php

abstract class jQueryTmpl_Token_Base implements jQueryTmpl_Token
{
    protected $_oTag = '{{';
    protected $_oTagLen = 2;
    protected $_cTag = '}}';
    protected $_cTagLen = 2;

    abstract protected function _getRawTmpl();
    abstract protected function _getTag();

    protected function _getStartTagLen()
    {
        return $this->_oTagLen + strlen($this->_getTag());
    }

    protected function _getTagOptions()
    {
        $regex = "/^{$this->_oTag}{$this->_getTag()}(.*?){$this->_cTag}/i";
        $matches = array();

        if (!preg_match($regex, $this->_getRawTmpl(), $matches))
        {
            throw new jQueryTmpl_Token_Exception('Could not parse out tag options.');
        }

        return trim($matches[1]);
    }

    protected function _isSimpleName($name)
    {
        return (preg_match('/^[a-z_$][0-9a-z_$]*$/i', $this->_getTagOptions()) == 1);
    }
}

