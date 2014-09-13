<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

unset($_SESSION['account/connections/view/messages']);

include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Connections',
            'href' => '..',
        ],
    ],
    "Connection #$id",
    Page\text('Are you sure you want to delete the connection?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete connection', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Delete Connection #$id?", $content, '../../../');
