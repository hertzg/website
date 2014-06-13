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

            $title = $data->title;
            if ($title === '') {
                $title = htmlspecialchars($data->url);
            } else {
                $title = htmlspecialchars($title);
            }

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'bookmark');

        } elseif ($type == 'contact' || $type == 'receivedContact') {

            $title = htmlspecialchars($data->full_name);

            if ($data->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);

        } elseif ($type == 'note' || $type == 'receivedNote') {

            $text = $data->text;

            if ($data->encrypt) {
                include_once '../fns/encrypt_text.php';
                $text = encrypt_text($text);
                $icon = 'encrypted-note';
            } else {
                $icon = 'note';
            }

            $title = htmlspecialchars($text);

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);

        } elseif ($type == 'task' || $type == 'receivedTask') {

            $title = htmlspecialchars($data->text);

            if ($data->top_priority) $icon = 'task-top-priority';
            else $icon = 'task';

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);

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
