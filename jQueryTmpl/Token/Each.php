<?php

/**
 *  A each block which will repeat for each item of the array provided. Will end
 *  with {{/each}}, for this implementation the index and value will not be
 *  configurable and will always be set to the default keys '$index' and
 *  '$value'.
 */
class jQueryTmpl_Token_Each extends jQueryTmpl_Token_BaseBlock
{
    private $_rawTmpl;
    private $_arrayName;

    public function parseString($str)
    {
        $this->_rawTmpl = $str;

        $this->_validateIsBlockTag();

        $this->_arrayName = $this->_getTagOptions();

        $this->_tokenize();
    }

    public function render(jQueryTmpl_Data $data)
    {
        // Set our 'magic' var names
        $magicNameIndex = '$index';
        $magicNameValue = '$value';

        $blockData = $data->getValueOf($this->_arrayName);

        if (!(is_array($blockData) || $blockData instanceof stdClass))
        {
            // If there is no valid data for this each block it becomes nothing.
            return '';
        }

        $rendered = '';

        foreach($blockData as $index => $value)
        {
            // Make a copy of the data to use as local
            $localObj = $data;

            // Add our magic local vars to copy of data
            $localObj
                ->addDataPair($magicNameIndex, $index)
                ->addDataPair($magicNameValue, $value)
                ->addDataPair('this', $value);

            // Now call each token and give them local data
            foreach ($this->_tokens as $token)
            {
                $rendered .= $token->render($localObj);
            }

            // Cleanup
            unset($localObj, $index, $value);
        }

        return $rendered;
    }

    protected function _getRawTmpl()
    {
        return $this->_rawTmpl;
    }

    protected function _getTag()
    {
        return 'each';
    }
}

