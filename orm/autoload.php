<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $path_to_class = explode('/', $class);
    if (file_exists($path_to_class[0]."/".$path_to_class[1].'.php')) {
        require_once($path_to_class[0]."/".$path_to_class[1].'.php');
    }
});