<?php

function require_tags () {

    include_once __DIR__.'/../../fns/Tags/request.php';
    Tags\request($tags, $tag_names, $tooManyTags);

    if ($tooManyTags) {
        include_once __DIR__.'/bad_request.php';
        bad_request('TOO_MANY_TAGS');
    }

    return [$tags, $tag_names];

}
