<?php

include_once '../fns/bookmark_method_page.php';
bookmark_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to edit.',
    ],
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
        'description' => 'Space-separated list of tags.',
    ],
]);
