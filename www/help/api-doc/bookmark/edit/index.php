<?php

include_once '../fns/bookmark_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
bookmark_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to edit.',
    ],
    [
        'name' => 'url',
        'description' => 'The new URL of the bookmark.',
    ],
    [
        'name' => 'title',
        'description' => 'The new title of the bookmark.',
    ],
    [
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
], [
    'BOOKMARK_NOT_FOUND' => "A bookmark with the ID doesn't exist.",
    'ENTER_URL' => 'The URL is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
