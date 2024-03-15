<?php

use function PHPSTORM_META\map;

function isNotNull($variable) {
    return !isset($variable) || empty($variable);
}



function checkMaxMin($max,$min) 
{
    return   ($min > $max)? true:false;
}

function getResult($pdo,$propName,$proptype,$minPrice,$maxPrice,$location,$userid)
    {
        $result = fetchResult($pdo,$propName,$proptype,$minPrice,$maxPrice,$location,$userid);
        return  $result;
    }