<?php

class jQueryTmpl_Token_Factory
{
    private $_tokenizerFactory;

    public function __construct()
    {
        $this->_tokenizerFactory = new jQueryTmpl_Tokenizer_Factory();
    }

    public function createComment($str)
    {
        $token = new jQueryTmpl_Token_Comment();
        $token->parseString($str);
        return $token;
    }

    public function createEach($str)
    {
        $token = new jQueryTmpl_Token_Each($this->_tokenizerFactory->create());
        $token->parseString($str);
        return $token;
    }

    public function createNoOp($str)
    {
        $token = new jQueryTmpl_Token_NoOp();
        $token->parseString($str);
        return $token;
    }

    public function createValueEscaped($str)
    {
        $token = new jQueryTmpl_Token_ValueEscaped();
        $token->parseString($str);
        return $token;
    }

    public function createValueNotEscaped($str)
    {
        $token = new jQueryTmpl_Token_ValueNotEscaped();
        $token->parseString($str);
        return $token;
    }
}

