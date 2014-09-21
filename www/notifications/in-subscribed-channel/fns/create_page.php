<?php

function create_page ($mysqli, &$user, &$id, $base = '') {

    include_once __DIR__.'/require_subscribed_channel.php';
    $values = require_subscribed_channel($mysqli, "$base..");
    list($subscribedChannel, $id, $user) = $values;

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/request_strings.php";
    list($offset) = request_strings('offset');
    $offset = abs((int)$offset);
    if ($offset % $limit) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    $options = [];

    include_once __DIR__.'/../../fns/create_channels_link.php';
    $options[] = create_channels_link($user, "$base../");

    include_once __DIR__.'/../../fns/create_subscribed_channels_link.php';
    $options[] = create_subscribed_channels_link($user, "$base../");

    $items = [];

    include_once "$fnsDir/Notifications/indexPageOnSubscribedChannel.php";
    $notifications = Notifications\indexPageOnSubscribedChannel(
        $mysqli, $id, $offset, $limit, $total);

    include_once __DIR__.'/../../fns/render_filtered_notifications.php';
    render_filtered_notifications($base, $id, $offset,
        $limit, $total, $notifications, $items, $options);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../../home/",
            ],
        ],
        'Notifications',
        Page\sessionMessages('notifications/in-subscribed-channel/messages')
        .'<div class="filterBar">'
            .'Channel: <b>'
                .htmlspecialchars($subscribedChannel->channel_name)
            .'</b>'
            .'<a class="rightButton clickable" title="Clear Filter"'
            ." href=\"$base..\">"
                .'<span class="icon no"></span>'
            .'</a>'
        .'</div>'
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', join('<div class="hr"></div>', $options))
    );

}
