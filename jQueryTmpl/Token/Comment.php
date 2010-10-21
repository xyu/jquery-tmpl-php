<?php

/**
 *  A comment token begins with '{{!' and ends with '}}' nothing should be
 *  rendered for this token.
 */
class jQueryTmpl_Token_Comment extends jQueryTmpl_Token_BaseInline
{
    private $_rawTmpl;

    public function parseString($str)
    {
        $this->_rawTmpl = $str;

        $this->_validateIsSingleTag();
    }

    public function render(jQueryTmpl_Data $data)
    {
        return '';
    }

    protected function _getRawTmpl()
    {
        return $this->_rawTmpl;
    }

    protected function _getTag()
    {
        return '!';
    }
}

