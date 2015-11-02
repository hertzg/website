<?php

namespace ApiCall;

function requireTags (&$tags, &$tag_names) {

    $fnsDir = __DIR__.'/../';

    include_once "$fnsDir/Tags/request.php";
    \Tags\request($tags, $tag_names, $tooManyTags);

    if ($tooManyTags) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        \ErrorJson\badRequest('"TOO_MANY_TAGS"');
    }

}
