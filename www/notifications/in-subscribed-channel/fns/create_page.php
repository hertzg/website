<?php

function create_page ($mysqli, $user,
    $subscribedChannel, &$scripts, &$notifications, $base = '') {

    $id = $subscribedChannel->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Paging/limit.php";
    $limit = Paging\limit();

    include_once "$fnsDir/Paging/requestOffset.php";
    $offset = Paging\requestOffset('..');

    $options = [];

    include_once __DIR__.'/../../fns/create_channels_link.php';
    $options[] = create_channels_link($user, "$base../");

    include_once __DIR__.'/../../fns/create_subscribed_channels_link.php';
    $options[] = create_subscribed_channels_link($user, "$base../");

    $items = [];

    include_once "$fnsDir/Notifications/indexPageOnSubscribedChannel.php";
    $notifications = Notifications\indexPageOnSubscribedChannel(
        $mysqli, $id, $offset, $limit, $total);

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, ['id' => $id]);

    include_once __DIR__.'/../../fns/render_filtered_notifications.php';
    render_filtered_notifications($base, $id, $offset,
        $limit, $total, $notifications, $items, $options, $scripts);

    unset(
        $_SESSION['home/messages'],
        $_SESSION['notifications/channels/messages'],
        $_SESSION['notifications/errors'],
        $_SESSION['notifications/messages']
    );

    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../../home/#notifications",
                'localNavigation' => true,
            ],
            'Notifications',
            Page\sessionMessages('notifications/in-subscribed-channel/messages')
            .'<div class="filterBar">'
                .'Channel: <b>'
                    .htmlspecialchars($subscribedChannel->channel_name)
                .'</b>'
                .'<span class="zeroSize"> </span>'
                .'<a class="rightButton clickable" title="Clear Filter"'
                ." href=\"$base..\">"
                    .'<span class="rightButton-icon icon no"></span>'
                    .'<span class="displayNone">Clear Filter</span>'
                .'</a>'
            .'</div>'
            .join('<div class="hr"></div>', $items)
        )
        .Page\panel('Options', join('<div class="hr"></div>', $options));

}
