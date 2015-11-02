<?php

namespace Connections;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($username, $can_send_bookmark, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note,
        $can_send_place, $can_send_task) = request_strings(
        'username', 'can_send_bookmark', 'can_send_channel',
        'can_send_contact', 'can_send_file', 'can_send_note',
        'can_send_place', 'can_send_task');

    $username = preg_replace('/\s+/', '', $username);

    if (preg_match('/^(.*?)@(.*)$/', $username, $match)) {
        $username = $match[1];
        $address = $match[2];
    } else {
        $address = null;
    }

    $can_send_bookmark = (bool)$can_send_bookmark;
    $can_send_channel = (bool)$can_send_channel;
    $can_send_contact = (bool)$can_send_contact;
    $can_send_file = (bool)$can_send_file;
    $can_send_note = (bool)$can_send_note;
    $can_send_place = (bool)$can_send_place;
    $can_send_task = (bool)$can_send_task;

    return [$username, $address, $can_send_bookmark, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note,
        $can_send_place, $can_send_task];

}
