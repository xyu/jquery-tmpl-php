<?php

/**
 *  A escaped value token begins with '{{=' and ends with '}}' entire token
 *  should be replaced with value of referenced var.
 */
class jQueryTmpl_Token_ValueEscaped extends jQueryTmpl_Token_BaseInline
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

    public function render(jQueryTmpl_Data $data)
    {
        return htmlspecialchars($data->getValueOf($this->_varName), ENT_COMPAT, 'UTF-8');
    }

    protected function _getRawTmpl()
    {
        return $this->_rawTmpl;
    }

    protected function _getTag()
    {
        return '=';
    }
}

