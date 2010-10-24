<?php

class jQueryTmpl_Token_IfEnd extends jQueryTmpl_Token_TypeBlock
{
    public function isBlockStart()
    {
        return false;
    }

    public function getBlockEndToken()
    {
        return '';
    }
}

