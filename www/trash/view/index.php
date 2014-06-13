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

    include_once '../../fns/Page/text.php';
    $title = $data->title;
    if ($title !== '') $items[] = Page\text(htmlspecialchars($title));
    $items[] = Page\text(htmlspecialchars($data->url));

    $tags = $data->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

} elseif ($type == 'contact' || $type == 'receivedContact') {

    include_once '../../fns/Form/label.php';
    $items[] = Form\label('Full name', $data->full_name);

    $alias = $data->alias;
    if ($alias !== '') $items[] = Form\label('Alias', $data->alias);

    $address = $data->address;
    if ($address !== '') $items[] = Form\label('Address', $data->address);

    $email = $data->email;
    if ($email !== '') $items[] = Form\label('Email', $data->email);

    $phone1 = $data->phone1;
    if ($phone1 !== '') $items[] = Form\label('Phone 1', $data->phone1);

    $phone2 = $data->phone2;
    if ($phone2 !== '') $items[] = Form\label('Phone 2', $data->phone2);

    $birthday_time = $data->birthday_time;
    if ($birthday_time !== null) {
        $items[] = Form\label('Birthday', date('F d, Y', $birthday_time));
    }

    $username = $data->username;
    if ($username !== '') {
        $items[] = Form\label('Username', $data->username);
    }

    $tags = $data->tags;
    if ($tags !== '') $items[] = Form\label('Tags', $data->tags);

} elseif ($type == 'note' || $type == 'receivedNote') {

    include_once '../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($data->text));

    $tags = $data->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

} elseif ($type == 'task' || $type == 'receivedTask') {

    include_once '../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($data->text));

    $tags = $data->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

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
