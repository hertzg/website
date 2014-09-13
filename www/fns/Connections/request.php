<?php

namespace Connections;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($username, $can_send_bookmark, $can_send_channel, $can_send_contact,
        $can_send_file, $can_send_note, $can_send_task) = request_strings(
        'username', 'can_send_bookmark', 'can_send_channel', 'can_send_contact',
        'can_send_file', 'can_send_note', 'can_send_task');

    $can_send_bookmark = (bool)$can_send_bookmark;
    $can_send_channel = (bool)$can_send_channel;
    $can_send_contact = (bool)$can_send_contact;
    $can_send_file = (bool)$can_send_file;
    $can_send_note = (bool)$can_send_note;
    $can_send_task = (bool)$can_send_task;

    return [$username, $can_send_bookmark, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note, $can_send_task];

}
