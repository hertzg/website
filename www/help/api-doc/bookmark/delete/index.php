<?php

include_once '../fns/bookmark_method_page.php';
bookmark_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to delete.',
    ],
], ['BOOKMARK_NOT_FOUND']);
