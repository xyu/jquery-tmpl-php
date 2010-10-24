<?php

class jQueryTmpl_Tokenizer
{
    private $_tokenFactory;
    private $_tags = array();

    public function __construct(jQueryTmpl_Token_Factory $tokenFactory)
    {
        $this->_tokenFactory = $tokenFactory;
    }

    public function addTag(jQueryTmpl_Tag $tag)
    {
        $this->_tags[] = $tag;
        return $this;
    }

    public function tokenize($template)
    {

    }
}

