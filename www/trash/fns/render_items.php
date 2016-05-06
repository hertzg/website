<?php

function render_items ($deletedItems, &$items, $base, $encryption_key) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($deletedItems as $deletedItem) {

        $id = $deletedItem->id;
        $options = ['id' => $id];
        $type = $deletedItem->data_type;
        $data = json_decode($deletedItem->data_json);

        if ($type == 'barChart') {
            include_once __DIR__.'/render_bar_chart.php';
            render_bar_chart($data, $title, $icon);
        } elseif ($type == 'bookmark' || $type == 'receivedBookmark') {
            include_once __DIR__.'/render_bookmark.php';
            render_bookmark($data, $title, $icon);
        } elseif ($type == 'calculation' || $type == 'receivedCalculation') {
            include_once __DIR__.'/render_calculation.php';
            render_calculation($data, $title, $icon);
        } elseif ($type == 'contact' || $type == 'receivedContact') {
            include_once __DIR__.'/render_contact.php';
            render_contact($id, $data, $title, $icon, $options);
        } elseif ($type == 'event' || $type == 'receivedEvent') {
            include_once __DIR__.'/render_event.php';
            render_event($data, $title, $icon);
        } elseif ($type == 'note') {
            include_once __DIR__.'/render_note.php';
            render_note($data, $encryption_key, $title, $icon);
        } elseif ($type == 'place' || $type == 'receivedPlace') {
            include_once __DIR__.'/render_place.php';
            render_place($data, $title, $icon);
        } elseif ($type == 'file' || $type == 'receivedFile') {
            include_once __DIR__.'/render_file.php';
            render_file($data, $title, $icon);
        } elseif ($type == 'folder' || $type == 'receivedFolder') {
            include_once __DIR__.'/render_folder.php';
            render_folder($data, $title, $icon);
        } elseif ($type == 'receivedNote') {
            include_once __DIR__.'/render_received_note.php';
            render_received_note($data, $title, $icon);
        } elseif ($type == 'schedule' || $type == 'receivedSchedule') {
            include_once __DIR__.'/render_schedule.php';
            render_schedule($data, $title, $icon);
        } elseif ($type == 'task' || $type == 'receivedTask') {
            include_once __DIR__.'/render_task.php';
            render_task($data, $title, $icon);
        } elseif ($type == 'wallet') {
            include_once __DIR__.'/render_wallet.php';
            render_wallet($data, $title, $icon);
        }

        $items[] = Page\imageArrowLinkWithDescription($title,
            'Deleted '.export_date_ago($deletedItem->insert_time),
            "{$base}view/?id=$id", $icon, $options);

    }

}
