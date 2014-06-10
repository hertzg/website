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

        $data_type = $deletedItem->data_type;
        $data_json = json_decode($deletedItem->data_json);

        $description = 'Deleted '.date_ago($deletedItem->insert_time);

        $href = "../view/?id=$deletedItem->id";

        if ($data_type == 'bookmark') {

            $title = $data_json->title;
            if ($title === '') {
                $title = htmlspecialchars($data_json->url);
            } else {
                $title = htmlspecialchars($title);
            }

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'bookmark');

        }

    }
} else {
    $items[] = Page\info('Trash is empty');
}

include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Trash',
    join('<div class="hr"></div>', $items)
);

include_once '../fns/echo_page.php';
echo_page($user, 'Trash', $content, $base);
