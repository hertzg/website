<?php

namespace Tags;

function parse ($tag_names) {

    include_once __DIR__.'/../str_collapse_spaces.php';
    $tag_names = str_collapse_spaces($tag_names);

    if ($tag_names === '') return [];

    $tag_names = explode(' ', $tag_names);
    $tag_names = array_unique($tag_names);
    $tag_names = array_values($tag_names);
    return $tag_names;

}
