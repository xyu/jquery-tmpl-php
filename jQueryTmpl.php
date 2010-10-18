<?php

spl_autoload_register(function($class){return spl_autoload(str_replace('_', '/', $class));});

class jQueryTmpl
{
}

