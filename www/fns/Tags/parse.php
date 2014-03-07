<?php

namespace Tags;

function parse ($tagnames) {

    include_once __DIR__.'/../str_collapse_spaces.php';
    $tagnames = str_collapse_spaces($tagnames);

    if ($tagnames === '') return array();

    $tagnames = explode(' ', $tagnames);
    $tagnames = array_unique($tagnames);
    return $tagnames;

}
