<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli, '../');

include_once '../fns/ViewPage/create.php';
include_once '../../fns/Page/confirmDialog.php';
$content =
    ViewPage\create($deletedItem, $title, $head)
    .Page\confirmDialog('Are you sure you want to purge the item?',
        'Yes, purge item', "submit.php?id=$id", "../view/?id=$id");

include_once '../../fns/echo_page.php';
echo_page($user, "Purge $title?", $content, '../../', [
    'head' => $head
        .'<link rel="stylesheet" type="text/css"'
        .' href="../../confirmDialog.compressed.css" />',
]);
