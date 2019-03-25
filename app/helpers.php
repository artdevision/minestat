<?php

function color_gpu($value)
{
    if($value >= 62 && $value < 73) {
        return "bg-yellow";
    }
    else if($value >= 73) {
        return "bg-red";
    } else {
        return "bg-green";
    }
}
