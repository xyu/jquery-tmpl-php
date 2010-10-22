<?php

/**
 *  A tmpl token object that is a block level token. This means within this one
 *  object there could be other tokens that need to be handled, so the content
 *  will need to be tokenized.
 */
abstract class jQueryTmpl_Token_BaseBlock extends jQueryTmpl_Token_Base
{
    private $_tokenizer;
    protected $_tokens;

    public function __construct(jQueryTmpl_Tokenizer $tokenizer)
    {
        $this->_tokenizer = $tokenizer;
        $this->_tokens = array();
    }

    protected function _tokenize()
    {
        $regex = "/^.*?({$this->_cTag})+?(.*){$this->_oTag}\/{$this->_getTag()}{$this->_cTag}$/ims";
        $matches = array();

        if (!preg_match($regex, $this->_getRawTmpl(), $matches))
        {
            throw new jQueryTmpl_Token_Exception('Could not parse out block tag content.');
        }

        $this->_tokens = $this->_tokenizer->tokenize(trim($matches[2]));
    }

    /**
     *  Validates that the template in question is a valid tag block.
     */
    protected function _validateIsBlockTag()
    {
        if (substr($this->_getRawTmpl(), 0, $this->_getStartTagLen($this->_getTag())) !== $this->_oTag.$this->_getTag())
        {
            throw new jQueryTmpl_Token_Exception("Tag must start with '{$this->_oTag}{$this->_getTag()}'.");
        }

        if (substr($this->_getRawTmpl(), -$this->_getEndBlockTagLen()) !== "{$this->_oTag}/{$this->_getTag()}{$this->_cTag}")
        {
            throw new jQueryTmpl_Token_Exception("Tag must end with '{$this->_oTag}/{$this->_getTag()}{$this->_cTag}'.");
        }
    }

    protected function _getTagOptions()
    {
        $regex = "/^{$this->_oTag}{$this->_getTag()}(.*?){$this->_cTag}/i";
        $matches = array();

        if (!preg_match($regex, $this->_getRawTmpl(), $matches))
        {
            throw new jQueryTmpl_Token_Exception('Could not parse out block tag options.');
        }

        return trim($matches[1]);
    }

    private function _getEndBlockTagLen()
    {
        // Something like "{{/some_tag}}"
        return $this->_oTagLen + 1 + strlen($this->_getTag()) + $this->_cTagLen;
    }
}

