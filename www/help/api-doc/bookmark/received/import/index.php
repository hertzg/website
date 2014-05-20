<?php

include_once '../fns/received_bookmark_method_page.php';
received_bookmark_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to import.',
    ],
], ['RECEIVED_BOOKMARK_NOT_FOUND']);
