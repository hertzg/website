<?php

function create_options_panel ($channel) {

    $id = $channel->id;

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../../../fns/Page/imageLink.php';

    $title = 'Post a Notification';
    $href = "../notify/?id=$id";
    $notifyLink = Page\imageArrowLink($title, $href, 'create-notification');

    $title = 'Users';
    $href = "../users/?id=$id";
    $num_users = $channel->num_users;
    if ($num_users) {
        include_once __DIR__.'/../../../../fns/Page/imageArrowLinkWithDescription.php';
        $description = "$num_users total.";
        $usersLink = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'users');
    } else {
        $usersLink = Page\imageArrowLink($title, $href, 'users');
    }

    if ($channel->receive_notifications) {
        $title = 'Forbid Notifications';
        $href = "submit-forbid.php?id=$id";
        $icon = 'forbid-notifications';
    } else {
        $title = 'Receive Notifications';
        $href = "submit-receive.php?id=$id";
        $icon = 'receive-notifications';
    }
    $receiveLink = Page\imageLink($title, $href, $icon);

    if ($channel->public) {
        $title = 'Mark as Private';
        $href = "submit-private.php?id=$id";
        $icon = 'lock';
    } else {
        $title = 'Mark as Public';
        $href = "submit-public.php?id=$id";
        $icon = 'unlock';
    }
    $publicLink = Page\imageLink($title, $href, $icon);

    $title = 'Delete';
    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($notifyLink, $usersLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($receiveLink, $publicLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Channel Options', $content);

}
