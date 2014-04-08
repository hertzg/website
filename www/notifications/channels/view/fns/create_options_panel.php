<?php

function create_options_panel ($channel) {

    $id = $channel->id;

    include_once __DIR__.'/../../../../fns/Page/imageArrowLink.php';
    include_once __DIR__.'/../../../../fns/Page/imageLink.php';

    $title = 'Randomize Key';
    $href = "../randomize-key/?id=$id";
    $randomizeKeyLink = Page\imageArrowLink($title, $href, 'randomize');

    $title = 'Users';
    $href = "../users/?id=$id";
    $usersLink = Page\imageArrowLink($title, $href, 'users');

    $title = 'Delete';
    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink($title, $href, 'trash-bin');

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

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($receiveLink, $randomizeKeyLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($usersLink, $deleteLink);

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Channel Options', $content);

}
