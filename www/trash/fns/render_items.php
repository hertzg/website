<?php

function render_items ($deletedItems, &$items, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($deletedItems as $deletedItem) {

        $type = $deletedItem->data_type;
        $data = json_decode($deletedItem->data_json);
        $description = 'Deleted '.export_date_ago($deletedItem->insert_time);

        $id = $deletedItem->id;
        $href = "{$base}view/?id=$id";
        $options = ['id' => $id];

        if ($type == 'barChart') {
            include_once __DIR__.'/render_bar_chart.php';
            render_bar_chart($data, $description, $href, $options, $items);
        } elseif ($type == 'bookmark' || $type == 'receivedBookmark') {
            include_once __DIR__.'/render_bookmark.php';
            render_bookmark($data, $description, $href, $options, $items);
        } elseif ($type == 'calculation' || $type == 'receivedCalculation') {
            include_once __DIR__.'/render_calculation.php';
            render_calculation($data, $description, $href, $options, $items);
        } elseif ($type == 'contact' || $type == 'receivedContact') {
            include_once __DIR__.'/render_contact.php';
            render_contact($data, $description, $href, $options, $items);
        } elseif ($type == 'event' || $type == 'receivedEvent') {
            include_once __DIR__.'/render_event.php';
            render_event($data, $description, $href, $options, $items);
        } elseif ($type == 'note') {
            include_once __DIR__.'/render_note.php';
            render_note($data, $description, $href,
                $options, $encryption_key, $items);
        } elseif ($type == 'place' || $type == 'receivedPlace') {
            include_once __DIR__.'/render_place.php';
            render_place($data, $description, $href, $options, $items);
        } elseif ($type == 'file' || $type == 'receivedFile') {
            include_once __DIR__.'/render_file.php';
            render_file($data, $description, $href, $options, $items);
        } elseif ($type == 'folder' || $type == 'receivedFolder') {
            include_once __DIR__.'/render_folder.php';
            render_folder($data, $description, $href, $options, $items);
        } elseif ($type == 'receivedNote') {
            include_once __DIR__.'/render_received_note.php';
            render_received_note($data, $description, $href, $options, $items);
        } elseif ($type == 'schedule' || $type == 'receivedSchedule') {
            include_once __DIR__.'/render_schedule.php';
            render_schedule($data, $description, $href, $options, $items);
        } elseif ($type == 'task' || $type == 'receivedTask') {
            include_once __DIR__.'/render_task.php';
            render_task($data, $description, $href, $options, $items);
        } elseif ($type == 'wallet') {
            include_once __DIR__.'/render_wallet.php';
            render_wallet($data, $description, $href, $options, $items);
        }

    }

}
