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
        $dataTokens = $this->_parseJsNotation($jsNotation);
    }

    private function _parseJsNotation($js)
    {
        $dataTokens = array();

        // Split based on '.' to traverse into object. Could be smarter...
        $loc = explode('.', $js);
        $len = count($loc);

        foreach($loc as $idx => $name)
        {
            $match = array();

            if (!preg_match('/^([a-z_$][0-9a-z_$]*)(\[.*\])?$/i', $name, $match))
            {
                throw new jQueryTmpl_Data_Exception('jQueryTmpl_Data can not evaluate expressions.');
            }

            $dataToken = array
            (
                'name' => $match[1]
            );

            if (!empty($match[2]))
            {
                // Use trim to extract the core value between brackets
                $dataToken['subpart'] = trim($match[2], ' \'"[]');
            }

            $dataTokens[] = $dataToken;
        }

        return $dataTokens;
    }
}

