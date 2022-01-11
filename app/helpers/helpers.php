<?php

function is_active(string $routeName)
{
    return null !== request()->segment(1) &&  request()->segment(1) == $routeName ? 'active' : '' ;
}
