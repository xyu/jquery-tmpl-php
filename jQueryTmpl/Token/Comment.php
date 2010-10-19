<?php

/**
 *  A comment token begins with '{{!' and ends with '}}' nothing should be
 *  rendered for this token.
 */
class jQueryTmpl_Token_Comment extends jQueryTmpl_Token_BaseInline
{
    public function parseString($str)
    {
        $this->_validateIsSingleTag($str, '!');
    }

    public function render(stdClass $data)
    {
        return '';
    }
}

