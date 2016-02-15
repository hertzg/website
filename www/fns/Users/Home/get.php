<?php

namespace Users\Home;

function get ($user) {

    $items = [];
    if ($user->show_admin && $user->admin) $items['admin'] = true;
    if ($user->show_bar_charts) $items['bar-charts'] = true;
    if ($user->show_new_bar_chart) $items['new-bar-chart'] = true;
    if ($user->show_bookmarks) $items['bookmarks'] = true;
    if ($user->show_new_bookmark) $items['new-bookmark'] = true;
    if ($user->show_calculations) $items['calculations'] = true;
    if ($user->show_new_calculation) $items['new-calculation'] = true;
    if ($user->show_calendar) $items['calendar'] = true;
    if ($user->show_new_event) $items['new-event'] = true;
    if ($user->show_contacts) $items['contacts'] = true;
    if ($user->show_new_contact) $items['new-contact'] = true;
    if ($user->show_files) $items['files'] = true;
    if ($user->show_upload_files) $items['upload-files'] = true;
    if ($user->show_notes) $items['new-note'] = true;
    if ($user->show_notifications) $items['post-notification'] = true;
    if ($user->show_places) $items['places'] = true;
    if ($user->show_new_place) $items['new-place'] = true;
    if ($user->show_schedules) $items['schedules'] = true;
    if ($user->show_new_schedule) $items['new-schedule'] = true;
    if ($user->show_tasks) $items['tasks'] = true;
    if ($user->show_new_task) $items['new-task'] = true;
    if ($user->show_wallets) $items['wallets'] = true;
    if ($user->show_new_transaction) $items['new-transaction'] = true;
    if ($user->show_transfer_amount) $items['transfer-amount'] = true;
    if ($user->show_trash) $items['trash'] = true;

    $sortedItems = [];
    $order_home_items = json_decode($user->order_home_items);
    foreach ($order_home_items as $key) {
        if (array_key_exists($key, $items)) $sortedItems[$key] = $items[$key];
    }

    return $sortedItems;

}
