<?php

class jQueryTmpl_Data
{
    private $_data;

    public function __construct(stdClass $data)
    {
        // The json_decode() returned stdObject
        $this->_data = $data;
    }

    public function getValueOf($jsNotation)
    {
    }
}

