<?php

class jQueryTmpl_Element_Factory
{
    public function createBlock($type, array $tokens)
    {
        $parserFactory = new jQueryTmpl_Parser_Factory();

        $element = new "jQueryTmpl_Element_$type"($parserFactory->create());
        $element
            ->parseTokens($tokens);

        return $element;
    }

    public function createControl($type, jQueryTmpl_Token $token)
    {
        $element = new "jQueryTmpl_Element_$type"();
        $element
            ->parseToken($token);

        return $element;
    }

    public function createInline($type, jQueryTmpl_Token $token)
    {
        $element = new "jQueryTmpl_Element_$type"();
        $element
            ->parseToken($token);

        return $element;
    }
}

