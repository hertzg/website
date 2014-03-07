<?php

function parse_tags ($tags, &$tagnames, &$errors) {

    include_once __DIR__.'/Tags/parse.php';
    $tagnames = Tags\parse($tags);

    include_once __DIR__.'/Tags/maxNumber.php';
    $maxNumber = Tags\maxNumber();

    if (count($tagnames) > $maxNumber) {
        $errors[] = "Please, enter maximum $maxNumber tags.";
    }

}
