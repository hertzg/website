<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bookmark_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
bookmark_method_page('add', [
    [
        'name' => 'url',
        'description' => 'The URL of the bookmark.',
    ],
    [
        'name' => 'title',
        'description' => 'The title of the bookmark.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created bookmark.',
], [
    'ENTER_URL' => 'The URL is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
