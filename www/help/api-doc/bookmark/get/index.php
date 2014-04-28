<?php

include_once '../fns/bookmark_method_page.php';
bookmark_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to get.',
    ],
], ['BOOKMARK_NOT_FOUND']);
