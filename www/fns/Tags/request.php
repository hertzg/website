<?php

namespace Tags;

function request (&$tags, &$tag_names, &$tooManyTags) {

    include_once __DIR__.'/../request_strings.php';
    list($tags) = request_strings('tags');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $tags = str_collapse_spaces($tags);

    include_once __DIR__.'/maxLength.php';
    $tags = mb_substr($tags, 0, maxLength(), 'UTF-8');

    include_once __DIR__.'/parse.php';
    $tag_names = parse($tags);

    include_once __DIR__.'/maxNumber.php';
    $maxNumber = maxNumber();

    $tooManyTags = count($tag_names) > $maxNumber;

}
