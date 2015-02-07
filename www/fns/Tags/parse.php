<?php

namespace Tags;

function parse (&$tags) {

    include_once __DIR__.'/../str_collapse_spaces.php';
    $tag_names = str_collapse_spaces($tags);

    if ($tag_names === '') return [];

    $tag_names = explode(' ', $tag_names);
    $tag_names = array_unique($tag_names);
    $tag_names = array_values($tag_names);

    usort($tag_names, function ($a, $b) {
        return strcasecmp($a, $b);
    });

    $tags = join(' ', $tag_names);

    return $tag_names;

}
