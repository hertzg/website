<?php

function join_and ($array, $comma = ', ', $and = ' and ') {
    $last = array_pop($array);
    if ($array) {
        return join($comma, $array).$and.$last;
    }
    return $last;
}
