<?php

function color_gpu($value)
{
    if($value >= 60 && $value < 70) {
        return "bg-yellow";
    }
    else if($value >= 70) {
        return "bg-red";
    } else {
        return "bg-green";
    }
}
