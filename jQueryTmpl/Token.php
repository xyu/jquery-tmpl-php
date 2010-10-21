<?php

interface jQueryTmpl_Token
{
    // The string to be turned into a token
    public function parseString($str);

    // Render the token with the given data.
    public function render(jQueryTmpl_Data $data);
}

