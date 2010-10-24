<?php

abstract class jQueryTmpl_Element_Base implements jQueryTmpl_Element
{
    protected $_data;

    public function setData(jQueryTmpl_Data $data)
    {
        $this->_data = $data;
        return $this;
    }
}

