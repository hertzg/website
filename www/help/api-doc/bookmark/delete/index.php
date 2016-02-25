<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bookmark_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
bookmark_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to delete.',
    ],
], ApiDoc\trueResult(), [
    'BOOKMARK_NOT_FOUND' => "A bookmark with the ID doesn't exist.",
]);
