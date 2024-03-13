<?php


function is_input_empty($propName,$price,$propType,$location,$description)
{
    if(empty($propName)||empty($price)||empty($location)||empty($description))
    {
        return true;
    }
    return false;
}


function create_property($pdo,$propName,$price,$propType,$location,$description,$image,$signup_id)
{
    set_property($pdo,$propName,$price,$propType,$location,$description,$image,$signup_id);
}