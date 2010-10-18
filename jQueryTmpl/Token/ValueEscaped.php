<?php

/**
 *  A escaped value token begins with '{{=' and ends with '}}' entire token
 *  should be replaced with value of referenced var.
 */
class jQueryTmpl_Token_ValueEscaped extends jQueryTmpl_Token_Base
{
    private $_varName;

    public function parseString($str)
    {
        $this->_validateIsSingleTag($str, '=');
        $this->_validateIsNotExpression($str, '=');

        $this->_varName = $this->_getTagContent($str, '=');
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
            return htmlspecialchars($data->$var, ENT_COMPAT, 'UTF-8');
        }
    }
}

