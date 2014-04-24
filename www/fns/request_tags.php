<?php

function request_tags (&$tags, &$tag_names, &$errors) {

    include_once __DIR__.'/request_strings.php';
    list($tags) = request_strings('tags');

    include_once __DIR__.'/str_collapse_spaces.php';
    $tags = str_collapse_spaces($tags);

    include_once __DIR__.'/Tags/parse.php';
    $tag_names = Tags\parse($tags);

    include_once __DIR__.'/Tags/maxNumber.php';
    $maxNumber = Tags\maxNumber();

    if (count($tag_names) > $maxNumber) {
        $errors[] = "Please, enter maximum $maxNumber tags.";
    }

}
