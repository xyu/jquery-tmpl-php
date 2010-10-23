<?php

/**
 *  The tokenizer produces tokens for each type of tag as well as
 *  NoOp tokens for html content.
 */
interface jQueryTmpl_Tokens
{
    /**
     *  Each token must be constructed with information about how far
     *  nested it is, the parsed out options array, and the raw
     *  content of the token.
     *  @param int $level Reletive level of nesting
     *  @param array $options Hash as returned by jQueryTmpl_Tags->parseTag()
     *  @param string $rawContent The entire tag or raw html content
     */
    public function __construct($level, array $options, $rawContent);

    /**
     *  Methods below simply gets the values set in the constructor.
     */
    public function getLevel();
    public function getOptions();
    public function getRawContent();
}

