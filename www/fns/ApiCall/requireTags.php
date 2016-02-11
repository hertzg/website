<?php

namespace ApiCall;

function requireTags (&$tags, &$tag_names) {

    include_once __DIR__.'/../Tags/request.php';
    \Tags\request($tags, $tag_names, $tooManyTags);

    if ($tooManyTags) {
        include_once __DIR__.'/Error/badRequest.php';
        Error\badRequest('"TOO_MANY_TAGS"');
    }

}
