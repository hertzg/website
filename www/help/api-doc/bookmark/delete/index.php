<?php

include_once '../fns/bookmark_method_page.php';
include_once '../../fns/true_result.php';
bookmark_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to delete.',
    ],
], true_result(), [
    'BOOKMARK_NOT_FOUND' => "A bookmark with the ID doesn't exist.",
]);
