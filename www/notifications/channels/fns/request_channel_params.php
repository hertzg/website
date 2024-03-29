<?php

function request_channel_params ($mysqli, &$errors, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Channels/request.php";
    list($channel_name, $public, $receive_notifications) = Channels\request();

    if ($channel_name === '') {
        $errors[] = 'Enter channel name.';
    } else {
        include_once "$fnsDir/ChannelName/containsIllegalChars.php";
        if (ChannelName\containsIllegalChars($channel_name)) {
            $errors[] = 'Channel name contains illegal characters.';
        } else {
            include_once "$fnsDir/ChannelName/isShort.php";
            if (ChannelName\isShort($channel_name)) {
                include_once "$fnsDir/ChannelName/minLength.php";
                $errors[] = 'Channel name too short. At least '
                    .ChannelName\minLength().' characters required.';
            } else {
                include_once "$fnsDir/Channels/getByName.php";
                $existingChannel = Channels\getByName(
                    $mysqli, $channel_name, $exclude_id);
                if ($existingChannel) {
                    $errors[] = 'A channel with this name already exists.';
                }
            }
        }
    }

    return [$channel_name, $public, $receive_notifications];

}
