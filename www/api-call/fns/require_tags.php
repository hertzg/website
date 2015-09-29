<?php

function require_tags () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Tags/request.php";
    Tags\request($tags, $tag_names, $tooManyTags);

    if ($tooManyTags) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"TOO_MANY_TAGS"');
    }

    return [$tags, $tag_names];

}
