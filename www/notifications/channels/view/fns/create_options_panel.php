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

    $href = "../edit/?id=$id";
    if ($channel->receive_notifications) $icon = 'edit-channel';
    else $icon = 'edit-inactive-channel';
    $editLink = Page\imageArrowLink('Edit', $href, $icon);

    $title = 'Delete';
    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink($title, $href, 'trash-bin');

    include_once __DIR__.'/../../../../fns/Page/twoColumns.php';
    $content =
        Page\twoColumns($notifyLink, $usersLink)
        .'<div class="hr"></div>'
        .Page\twoColumns($editLink, $deleteLink);

    include_once __DIR__.'/../../../../fns/create_panel.php';
    return create_panel('Channel Options', $content);

}
