<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

$items = [];

include_once '../fns/DeletedItems/indexOnUser.php';
include_once '../lib/mysqli.php';
$deletedItems = DeletedItems\indexOnUser($mysqli, $user->id_users);

if ($deletedItems) {

    include_once '../fns/date_ago.php';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($deletedItems as $deletedItem) {

        $type = $deletedItem->data_type;
        $data = json_decode($deletedItem->data_json);

        $description = 'Deleted '.date_ago($deletedItem->insert_time);

        $href = "view/?id=$deletedItem->id";

        if ($type == 'bookmark' || $type == 'receivedBookmark') {
            include_once 'fns/render_bookmark.php';
            render_bookmark($data, $description, $href, $items);
        } elseif ($type == 'contact' || $type == 'receivedContact') {
            include_once 'fns/render_contact.php';
            render_contact($data, $description, $href, $items);
        } elseif ($type == 'note' || $type == 'receivedNote') {
            include_once 'fns/render_note.php';
            render_note($data, $description, $href, $items);
        } elseif ($type == 'file' || $type == 'receivedFile') {
            include_once 'fns/render_file.php';
            render_file($data, $description, $href, $items);
        } elseif ($type == 'task' || $type == 'receivedTask') {
            include_once 'fns/render_task.php';
            render_task($data, $description, $href, $items);
        }

    }

    include_once '../fns/Page/imageArrowLink.php';
    $emptyLink = Page\imageArrowLink('Empty Trash', 'empty/', 'empty-trash');

    include_once '../fns/create_panel.php';
    $optionsPanel = create_panel('Options', $emptyLink);

} else {

    include_once '../fns/Page/info.php';
    $items[] = Page\info('Trash is empty');

    $optionsPanel = '';

}

include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Trash',
    Page\sessionMessages('trash/messages')
    .join('<div class="hr"></div>', $items)
    .$optionsPanel
);

include_once '../fns/echo_page.php';
echo_page($user, 'Trash', $content, $base);
