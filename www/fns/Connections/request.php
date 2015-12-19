<?php

namespace Connections;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($username, $can_send_bookmark, $can_send_calculation,
        $can_send_channel, $can_send_contact, $can_send_file,
        $can_send_note, $can_send_place,
        $can_send_schedule, $can_send_task) = request_strings(
        'username', 'can_send_bookmark', 'can_send_calculation',
        'can_send_channel', 'can_send_contact', 'can_send_file',
        'can_send_note', 'can_send_place',
        'can_send_schedule', 'can_send_task');

    $username = preg_replace('/\s+/', '', $username);

    include_once "$fnsDir/parse_username_address.php";
    parse_username_address($username, $username, $address);

    $can_send_bookmark = (bool)$can_send_bookmark;
    $can_send_calculation = (bool)$can_send_calculation;
    $can_send_channel = (bool)$can_send_channel;
    $can_send_contact = (bool)$can_send_contact;
    $can_send_file = (bool)$can_send_file;
    $can_send_note = (bool)$can_send_note;
    $can_send_place = (bool)$can_send_place;
    $can_send_schedule = (bool)$can_send_schedule;
    $can_send_task = (bool)$can_send_task;

    return [$username, $address, $can_send_bookmark,
        $can_send_calculation, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note,
        $can_send_place, $can_send_schedule, $can_send_task];

}
