<?php

class jQueryTmpl_Tag_Comment implements jQueryTmpl_Tag
{
    public function getTokenType()
    {
        return 'Comment';
    }

    public function getRegex()
    {
        return '/{{!.*?}}/s';
    }

    public function parseTag($rawTagString)
    {
        return array();
    }
}

