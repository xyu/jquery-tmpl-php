<?php

/**
 *  A no op token this returns the string as it is.
 */
class jQueryTmpl_Token_NoOp implements jQueryTmpl_Token
{
    private $_str;

    public function parseString($str)
    {
        $this->_str = $str;
    }

    public function render(stdClass $data)
    {
        return $this->_str;
    }
}

