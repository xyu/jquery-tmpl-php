<?php

class jQueryTmpl_Tag_ValueNotEscaped implements jQueryTmpl_Tag
{
    public function getTokenType()
    {
        return 'ValueNotEscaped';
    }

    public function getRegex()
    {
        return '/{{html.*?}}/is';
    }

    public function parseTag($rawTagString)
    {
        $matches = array();
        preg_match('/^{{html(.*)}}$/is', $rawTagString, $matches);

        return array
        (
            'name' => trim($matches[1])
        );
    }
}

