<?php

function request_tags (&$tags, &$tag_names, &$errors) {

    include_once __DIR__.'/Tags/request.php';
    Tags\request($tags, $tag_names, $tooManyTags);

    if ($tooManyTags) {

        include_once __DIR__.'/Tags/maxNumber.php';
        $maxNumber = Tags\maxNumber();

        $errors[] = "Please, enter maximum $maxNumber tags.";

    }

}
