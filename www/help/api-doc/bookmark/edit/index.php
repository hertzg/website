<?php

include_once '../fns/bookmark_method_page.php';
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
], ['BOOKMARK_NOT_FOUND', 'ENTER_URL', 'TOO_MANY_TAGS']);
