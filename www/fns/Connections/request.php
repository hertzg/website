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

    include_once "$fnsDir/str_collapse_spaces.php";
    $username = str_collapse_spaces($username);

    $can_send_bookmark = (bool)$can_send_bookmark;
    $can_send_channel = (bool)$can_send_channel;
    $can_send_contact = (bool)$can_send_contact;
    $can_send_file = (bool)$can_send_file;
    $can_send_note = (bool)$can_send_note;
    $can_send_place = (bool)$can_send_place;
    $can_send_task = (bool)$can_send_task;

    return [$username, $can_send_bookmark, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note,
        $can_send_place, $can_send_task];

}
