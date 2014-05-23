<?php

function create_options_panel ($subscribedChannel) {

    $id = $subscribedChannel->id;
    $items = [];

    include_once __DIR__.'/../../../../fns/Page/imageLink.php';
    if ($subscribedChannel->receive_notifications) {
        $title = 'Forbid Notifications';
        $href = "submit-forbid.php?id=$id";
        $items[] = Page\imageLink($title, $href, 'forbid-notifications');
    } else {
        $title = 'Receive Notifications';
        $href = "submit-receive.php?id=$id";
        $items[] = Page\imageLink($title, $href, 'receive-notifications');
    }

    if ($subscribedChannel->subscriber_locked) {
        $href = "../unsubscribe/?id=$id";
        $items[] = Page\imageLink('Unsubscribe', $href, 'trash-bin');
    } elseif ($subscribedChannel->channel_public &&
        !$subscribedChannel->subscriber_locked) {

        $href = "submit-subscribe.php?id=$id";
        $icon = 'create-subscribed-channel';
        $items[] = Page\imageLink('Subscribe', $href, $icon);

    }

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Channel Options', join('<div class="hr"></div>', $items));

}
