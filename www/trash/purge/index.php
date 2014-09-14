<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

include_once '../fns/item_type_name.php';
$typeName = item_type_name($deletedItem->data_type);

include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "$typeName #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Purge',
    Page\text('Are you sure you want to purge the item?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, purge item', "submit.php?id=$id", 'yes'),
        Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, "Purge $typeName #$id", $content, '../../');
