<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

$items = [];

$type = $deletedItem->data_type;
$data = json_decode($deletedItem->data_json);

include_once '../fns/item_type_name.php';
$typeName = item_type_name($type);

if ($type == 'bookmark' || $type == 'receivedBookmark') {
    include_once 'fns/render_bookmark.php';
    render_bookmark($data, $items);
} elseif ($type == 'contact' || $type == 'receivedContact') {
    include_once 'fns/render_contact.php';
    render_contact($data, $items);
} elseif ($type == 'note' || $type == 'receivedNote') {
    include_once 'fns/render_note.php';
    render_note($data, $items);
} elseif ($type == 'task' || $type == 'receivedTask') {
    include_once 'fns/render_task.php';
    render_task($data, $items);
}

include_once '../../fns/Page/imageLink.php';
$purgeLink = Page\imageLink('Purge', "../purge/?id=$id", 'purge');

$href = "submit-restore.php?id=$id";
$restoreLink = Page\imageLink('Restore', $href, 'restore-defaults');

include_once '../../fns/Page/twoColumns.php';
$optionsContent = Page\twoColumns($restoreLink, $purgeLink);

unset($_SESSION['trash/messages']);

include_once '../../fns/create_panel.php';
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
    .Page\infoText(ucfirst(strtolower($typeName)).' deleted '.date_ago($deletedItem->insert_time).'.')
    .create_panel("$typeName Options", $optionsContent)
);

include_once '../../fns/echo_page.php';
echo_page($user, "$typeName #$id", $content, '../../');
