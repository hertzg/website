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
    $usersLink = Page\imageArrowLink($title, $href, 'users');

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
        $icon = 'TODO';
    } else {
        $title = 'Mark as Public';
        $href = "submit-public.php?id=$id";
        $icon = 'TODO';
    }
    $publicLink = Page\imageLink($title, $href, $icon);

    $title = 'Randomize Key';
    $href = "../randomize-key/?id=$id";
    $randomizeKeyLink = Page\imageArrowLink($title, $href, 'randomize');

    $title = 'Delete';
    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($notifyLink, $usersLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($receiveLink, $publicLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($randomizeKeyLink, $deleteLink);

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Channel Options', $content);

}
