<?php

function parse_tags ($tags, &$tag_names, &$errors) {

    include_once __DIR__.'/Tags/parse.php';
    $tag_names = Tags\parse($tags);

    include_once __DIR__.'/Tags/maxNumber.php';
    $maxNumber = Tags\maxNumber();

    if (count($tag_names) > $maxNumber) {
        $errors[] = "Please, enter maximum $maxNumber tags.";
    }

}
