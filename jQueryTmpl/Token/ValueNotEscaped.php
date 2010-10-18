<?php

/**
 *  A escaped value token begins with '{{html' and ends with '}}' entire token
 *  should be replaced with value of referenced var.
 */
class jQueryTmpl_Token_ValueNotEscaped extends jQueryTmpl_Token_Base
{
    private $_varName;

    public function parseString($str)
    {
        $this->_validateIsSingleTag($str, 'html');
        $this->_validateIsNotExpression($str, 'html');

        $this->_varName = $this->_getTagContent($str, 'html');
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
}

