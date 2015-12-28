<?php

namespace ViewPage;

function create ($mysqli, $deletedItem, $user, &$title, &$head, &$scripts) {

    $id = $deletedItem->id;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .= compressed_js_script('dateAgo', $base);

    $items = [];

    $type = $deletedItem->data_type;
    $data = json_decode($deletedItem->data_json);

    include_once "$fnsDir/format_author.php";
    $author = format_author($deletedItem->insert_time,
        $deletedItem->insert_api_key_name);
    include_once __DIR__.'/../item_type_lowercase_name.php';
    $infoText = item_type_lowercase_name($type)." deleted $author.";

    if ($type == 'barChart') {
        include_once __DIR__.'/renderBarChart.php';
        renderBarChart($data, $items);
    } elseif ($type == 'bookmark' || $type == 'receivedBookmark') {
        include_once __DIR__.'/renderBookmark.php';
        renderBookmark($data, $items);
    } elseif ($type == 'calculation' || $type == 'receivedCalculation') {
        include_once __DIR__.'/renderCalculation.php';
        renderCalculation($data, $items);
    } elseif ($type == 'contact' || $type == 'receivedContact') {

        include_once __DIR__.'/renderContact.php';
        renderContact($id, $data, $items, $infoText, $scripts);

        include_once "$fnsDir/compressed_css_link.php";
        $head = compressed_css_link('contact', $base);

    } elseif ($type == 'event') {
        include_once __DIR__.'/renderEvent.php';
        renderEvent($data, $items);
    } elseif ($type == 'note') {
        include_once __DIR__.'/renderNote.php';
        renderNote($data, $items, $infoText);
    } elseif ($type == 'place' || $type == 'receivedPlace') {
        include_once __DIR__.'/renderPlace.php';
        renderPlace($data, $items);
    } elseif ($type == 'file') {
        include_once __DIR__.'/renderFile.php';
        renderFile($mysqli, $deletedItem, $items);
    } elseif ($type == 'folder' || $type == 'receivedFolder') {
        include_once __DIR__.'/renderFolder.php';
        renderFolder($data, $items);
    } elseif ($type == 'receivedFile') {
        include_once __DIR__.'/renderReceivedFile.php';
        renderReceivedFile($mysqli, $deletedItem, $items);
    } elseif ($type == 'receivedNote') {
        include_once __DIR__.'/renderReceivedNote.php';
        renderReceivedNote($data, $items, $infoText);
    } elseif ($type == 'schedule' || $type == 'receivedSchedule') {
        include_once __DIR__.'/renderSchedule.php';
        renderSchedule($data, $user, $items);
    } elseif ($type == 'task' || $type == 'receivedTask') {
        include_once __DIR__.'/renderTask.php';
        renderTask($data, $user, $items, $infoText);
    } elseif ($type == 'wallet') {
        include_once __DIR__.'/renderWallet.php';
        renderWallet($data, $items, $infoText);
    }

    include_once __DIR__.'/../item_type_name.php';
    $typeName = item_type_name($type);

    $content = join('<div class="hr"></div>', $items);

    if ($type == 'receivedBookmark' || $type == 'receivedCalculation' ||
        $type == 'receivedContact' || $type == 'receivedFile' ||
        $type == 'receivedFolder' || $type == 'receivedNote' ||
        $type == 'receivedPlace' || $type == 'receivedSchedule' ||
        $type == 'receivedTask') {

        include_once "$fnsDir/create_panel.php";
        include_once "$fnsDir/create_received_from_item.php";
        $content = create_received_from_item($data)
            .create_panel("The $typeName", $content);

    }

    include_once __DIR__.'/../item_type_title.php';
    $title = item_type_title($type)." #$data->id";

    unset(
        $_SESSION['trash/errors'],
        $_SESSION['trash/messages']
    );

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    return \Page\create(
        [
            'title' => 'Trash',
            'href' => "../#$id",
        ],
        $title,
        $content.\Page\infoText($infoText)
        .optionsPanel($typeName, $id)
    );

}
