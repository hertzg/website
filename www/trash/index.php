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
    include_once '../fns/Page/imageArrowLink.php';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    foreach ($deletedItems as $deletedItem) {

        $data_type = $deletedItem->data_type;
        $data_json = json_decode($deletedItem->data_json);

        $description = 'Deleted '.date_ago($deletedItem->insert_time);

        $href = "view/?id=$deletedItem->id";

        if ($data_type == 'bookmark') {

            $title = $data_json->title;
            if ($title === '') {
                $title = htmlspecialchars($data_json->url);
            } else {
                $title = htmlspecialchars($title);
            }

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'bookmark');

        } elseif ($data_type == 'contact') {

            $title = htmlspecialchars($data_json->full_name);

            if ($data_json->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);

        } elseif ($data_type == 'note') {

            $text = $data_json->text;

            if ($data_json->encrypt) {
                include_once '../fns/encrypt_text.php';
                $text = encrypt_text($text);
                $icon = 'encrypted-note';
            } else {
                $icon = 'note';
            }

            $title = htmlspecialchars($text);

            $items[] = Page\imageArrowLink($title, $href, $icon);

        } elseif ($data_type == 'task') {

            if ($data_json->top_priority) $icon = 'task-top-priority';
            else $icon = 'task';

            $title = htmlspecialchars($data_json->text);

            $tags = $data_json->tags;
            if ($tags === '') {
                $items[] = Page\imageArrowLink($title, $href, $icon);
            } else {
                $description = htmlspecialchars($tags);
                $items[] = Page\imageArrowLinkWithDescription(
                    $title, $description, $href, $icon);
            }
        }

    }

    include_once '../fns/Page/imageArrowLink.php';
    $emptyLink = Page\imageArrowLink('Empty Trash', 'empty/', 'TODO');

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
