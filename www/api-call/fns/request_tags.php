<?php

function request_tags () {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($tags) = request_strings('tags');

    include_once __DIR__.'/../../fns/Tags/parse.php';
    $tag_names = Tags\parse($tags);

    include_once __DIR__.'/../../fns/Tags/maxNumber.php';
    $maxNumber = Tags\maxNumber();

    if (count($tag_names) > $maxNumber) {
        include_once __DIR__.'/bad_request.php';
        bad_request('TOO_MANY_TAGS');
    }

    return [$tags, $tag_names];

}
