<?php

if (! function_exists('query')) {
    function query($queryLog)
    {
        return array_map(function ($queryItem) {
            return vsprintf(str_replace('?', '\'%s\'', $queryItem['query']), $queryItem['bindings']);
        }, $queryLog);
    }
}
