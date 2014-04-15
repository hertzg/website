<?php

function create_options_panel ($subscribed_channel) {

    $id = $subscribed_channel->id;

    include_once __DIR__.'/../../../../fns/Page/imageLink.php';
    if ($subscribed_channel->receive_notifications) {
        $title = 'Forbid Notifications';
        $href = "submit-forbid.php?id=$id";
        $link = Page\imageLink($title, $href, 'forbid-notifications');
    } else {
        $title = 'Receive Notifications';
        $href = "submit-receive.php?id=$id";
        $link = Page\imageLink($title, $href, 'receive-notifications');
    }

    if ($subscribed_channel->public_subscriber) {
        $href = "../unsubscribe/?id=$id";
        $deleteLink =
            '<div class="hr"></div>'
            .Page\imageLink('Unsubscribe', $href, 'trash-bin');
    } else {
        $deleteLink = '';
    }

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Options', $link.$deleteLink);

}
