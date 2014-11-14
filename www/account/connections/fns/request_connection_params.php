<?php

function request_connection_params ($user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Connections/request.php";
    list($username, $can_send_bookmark, $can_send_channel, $can_send_contact,
        $can_send_file, $can_send_note, $can_send_task) = Connections\request();

    include_once "$fnsDir/request_strings.php";
    list($expires) = request_strings('expires');

    include_once __DIR__.'/../../fns/parse_expire_time.php';
    parse_expire_time($user, $expires, $expire_time);

    return [$username, $expires, $expire_time, $can_send_bookmark,
        $can_send_channel, $can_send_contact, $can_send_file,
        $can_send_note, $can_send_task];

}
