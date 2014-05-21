<?php

include_once '../fns/received_bookmark_method_page.php';
received_bookmark_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to copy.',
    ],
], ['RECEIVED_BOOKMARK_NOT_FOUND']);
