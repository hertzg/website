<?php

function request_connection_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Connections/request.php";
    list($username, $address, $can_send_bookmark, $can_send_calculation,
        $can_send_channel, $can_send_contact, $can_send_file,
        $can_send_note, $can_send_place, $can_send_schedule,
        $can_send_task) = Connections\request();

    include_once "$fnsDir/request_strings.php";
    list($expires) = request_strings('expires');

    include_once "$fnsDir/parse_expire_time.php";
    parse_expire_time($expires, $expire_time);

    return [$username, $address, $expires, $expire_time,
        $can_send_bookmark, $can_send_calculation, $can_send_channel,
        $can_send_contact, $can_send_file, $can_send_note, $can_send_place,
        $can_send_schedule, $can_send_task];

}
