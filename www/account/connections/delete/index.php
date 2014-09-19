<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

unset($_SESSION['account/connections/view/messages']);

include_once '../fns/create_view_page.php';
include_once '../../../fns/Page/confirmDialog.php';
$content =
    create_view_page($connection)
    .Page\confirmDialog('Are you sure you want to delete the connection?',
        'Yes, delete connection', "submit.php?id=$id", "../view/?id=$id");

include_once '../../../fns/echo_page.php';
echo_page($user, "Delete Connection #$id?", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css"'
        .' href="../../../confirmDialog.compressed.css" />',
]);
