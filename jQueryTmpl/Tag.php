<?php

/**
 *  Tags define the jQuery tmpl tags that should be parsed out and
 *  operated on.
 */
interface jQueryTmpl_Tag
{
    /**
     *  The regex to use in order to search for this tag, within a
     *  string block. This regex should extract the entire block
     *  including opening and closing tag markers.
     *  @return string The regex string for preg_match_all()
     */
    public function getRegex();

    /**
     *  Given a entire tag this method should be able to parse out
     *  the required and optional paramiters the user specified.
     *  @param string $rawTagString The complete tag.
     *  @return array A hash of options as defined by the syntax.
     */
    public function parseTag($rawTagString);
}

