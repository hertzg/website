<?php

namespace ViewPage;

function optionsPanel ($subscribedChannel) {

    $fnsDir = __DIR__.'/../../../../fns';
    $id = $subscribedChannel->id;
    $items = [];

    include_once "$fnsDir/Page/imageLink.php";
    if ($subscribedChannel->receive_notifications) {
        $title = 'Forbid Notifications';
        $href = "submit-forbid.php?id=$id";
        $items[] = \Page\imageLink($title, $href, 'forbid-notifications');
    } else {
        $title = 'Receive Notifications';
        $href = "submit-receive.php?id=$id";
        $items[] = \Page\imageLink($title, $href, 'receive-notifications');
    }

    if ($subscribedChannel->subscriber_locked) {
        $href = "../unsubscribe/?id=$id";
        $items[] =
            '<div id="unsubscribeLink">'
                .\Page\imageLink('Unsubscribe', $href, 'trash-bin')
            .'</div>';
    } elseif ($subscribedChannel->channel_public &&
        !$subscribedChannel->subscriber_locked) {

        $href = "submit-subscribe.php?id=$id";
        $icon = 'create-subscribed-channel';
        $items[] = \Page\imageLink('Subscribe', $href, $icon);

    }

    $content = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Channel Options', $content);

}
