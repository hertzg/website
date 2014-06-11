<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

$items = [];

$data_type = $deletedItem->data_type;
$data_json = json_decode($deletedItem->data_json);

if ($data_type == 'bookmark') {

    $typeName = 'Bookmark';

    include_once '../../fns/Page/text.php';
    $title = $data_json->title;
    if ($title !== '') {
        $items[] = Page\text(htmlspecialchars($title));
    }
    $items[] = Page\text(htmlspecialchars($data_json->url));

}

include_once '../../fns/date_ago.php';
include_once '../../fns/Page/infoText.php';
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
    "$typeName #$id",
    join('<div class="hr"></div>', $items)
    .Page\infoText("$typeName deleted ".date_ago($deletedItem->insert_time).'.')
);

include_once '../../fns/echo_page.php';
echo_page($user, "$typeName #$id", $content, '../../');
