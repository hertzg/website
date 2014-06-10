<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Trash',
            'href' => '..',
        ],
    ],
    "Trash Item #$id",
    ''
);

include_once '../../fns/echo_page.php';
echo_page($user, "Trash Item #$id", $content, '../../');
