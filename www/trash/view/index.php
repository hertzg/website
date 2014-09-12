<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

$items = [];

$type = $deletedItem->data_type;
$data = json_decode($deletedItem->data_json);

include_once '../fns/item_type_name.php';
$typeName = item_type_name($type);

include_once '../../fns/date_ago.php';
$infoText = "$typeName deleted ".date_ago($deletedItem->insert_time).'.';

$base = '../../';
$head = '';

if ($type == 'bookmark' || $type == 'receivedBookmark') {
    include_once 'fns/render_bookmark.php';
    render_bookmark($data, $items);
} elseif ($type == 'contact' || $type == 'receivedContact') {

    include_once 'fns/render_contact.php';
    render_contact($id, $data, $items, $infoText);

    include_once '../../fns/get_revision.php';
    $cssRevision = get_revision('contact.compressed.css');

    $head = '<link rel="stylesheet" type="text/css"'
        ." href=\"{$base}contact.compressed.css?$cssRevision\" />";

} elseif ($type == 'note' || $type == 'receivedNote') {
    include_once 'fns/render_note.php';
    render_note($data, $items);
} elseif ($type == 'file' || $type == 'receivedFile') {
    include_once 'fns/render_file.php';
    render_file($id, $data, $items);
} elseif ($type == 'folder' || $type == 'receivedFolder') {
    include_once 'fns/render_folder.php';
    render_folder($data, $items);
} elseif ($type == 'task' || $type == 'receivedTask') {
    include_once 'fns/render_task.php';
    render_task($data, $items, $infoText);
}

if ($type == 'receivedBookmark' || $type == 'receivedContact'
    || $type == 'receivedFile' || $type == 'receivedFolder'
    || $type == 'receivedNote' || $type == 'receivedTask') {

    $senderUsername = htmlspecialchars($data->sender_username);

    include_once '../../fns/create_panel.php';
    include_once '../../fns/Form/label.php';
    $content =
        Form\label('Received from', $senderUsername)
        .create_panel("The $typeName", join('<div class="hr"></div>', $items));

} else {
    $content = join('<div class="hr"></div>', $items);
}

include_once '../../fns/Page/imageLink.php';
$purgeLink = Page\imageLink('Purge', "../purge/?id=$id", 'purge');

$href = "submit-restore.php?id=$id";
$restoreLink = Page\imageLink('Restore', $href, 'restore-defaults');

include_once '../../fns/Page/staticTwoColumns.php';
$optionsContent = Page\staticTwoColumns($restoreLink, $purgeLink);

unset($_SESSION['trash/messages']);

include_once '../fns/item_type_title.php';
$title = item_type_title($type)." #$id";

include_once '../../fns/create_panel.php';
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
    $title,
    $content
    .Page\infoText($infoText)
    .create_panel("$typeName Options", $optionsContent)
);

include_once '../../fns/echo_page.php';
echo_page($user, $title, $content, $base, [
    'head' => $head,
]);
