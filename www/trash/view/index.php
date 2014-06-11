<?php

include_once '../fns/require_deleted_item.php';
include_once '../../lib/mysqli.php';
list($deletedItem, $id, $user) = require_deleted_item($mysqli);

$items = [];

$data_type = $deletedItem->data_type;
$data_json = json_decode($deletedItem->data_json);

include_once '../fns/item_type_name.php';
$typeName = item_type_name($data_type);

if ($data_type == 'bookmark') {

    include_once '../../fns/Page/text.php';
    $title = $data_json->title;
    if ($title !== '') $items[] = Page\text(htmlspecialchars($title));
    $items[] = Page\text(htmlspecialchars($data_json->url));

    $tags = $data_json->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

} elseif ($data_type == 'contact') {

    include_once '../../fns/Form/label.php';
    $items[] = Form\label('Full name', $data_json->full_name);

    $alias = $data_json->alias;
    if ($alias !== '') $items[] = Form\label('Alias', $data_json->alias);

    $address = $data_json->address;
    if ($address !== '') $items[] = Form\label('Address', $data_json->address);

    $email = $data_json->email;
    if ($email !== '') $items[] = Form\label('Email', $data_json->email);

    $phone1 = $data_json->phone1;
    if ($phone1 !== '') $items[] = Form\label('Phone 1', $data_json->phone1);

    $phone2 = $data_json->phone2;
    if ($phone2 !== '') $items[] = Form\label('Phone 2', $data_json->phone2);

    $birthday_time = $data_json->birthday_time;
    if ($birthday_time !== null) {
        $items[] = Form\label('Birthday', date('F d, Y', $birthday_time));
    }

    $username = $data_json->username;
    if ($username !== '') {
        $items[] = Form\label('Username', $data_json->username);
    }

    $tags = $data_json->tags;
    if ($tags !== '') $items[] = Form\label('Tags', $data_json->tags);

} elseif ($data_type == 'note') {

    include_once '../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($data_json->text));

    $tags = $data_json->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

} elseif ($data_type == 'task') {

    include_once '../../fns/Page/text.php';
    $items[] = Page\text(htmlspecialchars($data_json->text));

    $tags = $data_json->tags;
    if ($tags !== '') $items[] = Page\text('Tags: '.htmlspecialchars($tags));

}

include_once '../../fns/Page/imageLink.php';
$purgeLink = Page\imageLink('Purge', "../purge/?id=$id", 'TODO');

$restoreLink = Page\imageLink('Restore', "submit-restore.php?id=$id", 'TODO');

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
    .Page\infoText("$typeName deleted ".date_ago($deletedItem->insert_time).'.')
    .create_panel("$typeName Options", $optionsContent)
);

include_once '../../fns/echo_page.php';
echo_page($user, "$typeName #$id", $content, '../../');
