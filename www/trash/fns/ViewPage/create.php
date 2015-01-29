<?php

namespace ViewPage;

function create ($deletedItem, $user, &$title, &$head) {

    $id = $deletedItem->id;
    $fnsDir = __DIR__.'/../../../fns';

    $items = [];

    $type = $deletedItem->data_type;
    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../item_type_name.php';
    $typeName = item_type_name($type);

    include_once "$fnsDir/format_author.php";
    $author = format_author($deletedItem->insert_time,
        $deletedItem->insert_api_key_name);
    $infoText = "$typeName deleted $author.";

    $head = '';
    $scripts = '';

    if ($type == 'bookmark' || $type == 'receivedBookmark') {
        include_once __DIR__.'/renderBookmark.php';
        renderBookmark($data, $items);
    } elseif ($type == 'contact' || $type == 'receivedContact') {

        include_once __DIR__.'/renderContact.php';
        renderContact($id, $data, $items, $infoText, $scripts);

        include_once "$fnsDir/compressed_css_link.php";
        $head = compressed_css_link('contact', '../../');

    } elseif ($type == 'note' || $type == 'receivedNote') {
        include_once __DIR__.'/renderNote.php';
        renderNote($data, $items);
    } elseif ($type == 'file' || $type == 'receivedFile') {
        include_once __DIR__.'/renderFile.php';
        renderFile($id, $data, $items);
    } elseif ($type == 'folder' || $type == 'receivedFolder') {
        include_once __DIR__.'/renderFolder.php';
        renderFolder($data, $items);
    } elseif ($type == 'task' || $type == 'receivedTask') {
        include_once __DIR__.'/renderTask.php';
        renderTask($data, $user, $items, $infoText);
    }

    if ($type == 'receivedBookmark' || $type == 'receivedContact'
        || $type == 'receivedFile' || $type == 'receivedFolder'
        || $type == 'receivedNote' || $type == 'receivedTask') {

        $senderUsername = htmlspecialchars($data->sender_username);

        $panelContent = join('<div class="hr"></div>', $items);

        include_once "$fnsDir/create_panel.php";
        include_once "$fnsDir/Form/label.php";
        $content =
            \Form\label('Received from', $senderUsername)
            .create_panel("The $typeName", $panelContent);

    } else {
        $content = join('<div class="hr"></div>', $items);
    }

    include_once "$fnsDir/Page/imageLink.php";
    $purgeLink =
        '<div id="purgeLink">'
            .\Page\imageLink('Purge', "../purge/?id=$id", 'purge')
        .'</div>';

    $href = "../submit-restore.php?id=$id";
    $restoreLink = \Page\imageLink('Restore', $href, 'restore-defaults');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = \Page\staticTwoColumns($restoreLink, $purgeLink);

    include_once '../fns/item_type_title.php';
    $title = item_type_title($type)." #$data->id";

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Trash',
                    'href' => "../#$id",
                ],
            ],
            $title,
            $content
            .\Page\infoText($infoText)
            .create_panel("$typeName Options", $optionsContent)
        )
        .$scripts;

}
