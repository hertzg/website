<?php

namespace Users\Account;

function editAnonymousConnection ($mysqli, $user,
    $can_send_bookmark, $can_send_calculation, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note, $can_send_place,
    $can_send_schedule, $can_send_task, &$changed) {

    if ((bool)$user->anonymous_can_send_bookmark === $can_send_bookmark &&
        (bool)$user->anonymous_can_send_calculation === $can_send_calculation &&
        (bool)$user->anonymous_can_send_channel === $can_send_channel &&
        (bool)$user->anonymous_can_send_contact === $can_send_contact &&
        (bool)$user->anonymous_can_send_file === $can_send_file &&
        (bool)$user->anonymous_can_send_note === $can_send_note &&
        (bool)$user->anonymous_can_send_place === $can_send_place &&
        (bool)$user->anonymous_can_send_schedule === $can_send_schedule &&
        (bool)$user->anonymous_can_send_task === $can_send_task) return;

    $changed = true;

    include_once __DIR__.'/../editAnonymousConnection.php';
    \Users\editAnonymousConnection($mysqli, $user->id_users,
        $can_send_bookmark, $can_send_calculation, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note, $can_send_place,
        $can_send_schedule, $can_send_task);

}
