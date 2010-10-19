<?php

/**
 *  A escaped value token begins with '{{html' and ends with '}}' entire token
 *  should be replaced with value of referenced var.
 */
class jQueryTmpl_Token_ValueNotEscaped extends jQueryTmpl_Token_BaseInline
{
    private $_rawTmpl;
    private $_varName;

    public function parseString($str)
    {
        $this->_rawTmpl = $str;

        $this->_validateIsSingleTag();
        $this->_validateIsNotExpression();

        $this->_varName = $this->_getTagOptions();
    }

    public function render(stdClass $data)
    {
        $var = $this->_varName;

        if (empty($var))
        {
            return '';
        }
        else
        {
            return $data->$var;
        }
    }

    protected function _getRawTmpl()
    {
        return $this->_rawTmpl;
    }

    protected function _getTag()
    {
        return 'html';
    }
}
