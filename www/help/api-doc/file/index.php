<?php

include_once 'fns/get_methods.php';
include_once '../fns/group_page.php';
group_page('file', get_methods(), [
    'received' => [
        'title' => 'Received',
        'description' => 'Methods for manipulating received files',
    ],
]);
