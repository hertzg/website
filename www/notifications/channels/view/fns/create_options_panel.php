<?php

function create_options_panel ($channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    $id = $channel->id;

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";

    $title = 'Post a Notification';
    $href = "../notify/?id=$id";
    $notifyLink = Page\imageArrowLink($title, $href, 'create-notification');

    $title = 'Users';
    $href = "../users/?id=$id";
    $num_users = $channel->num_users;
    if ($num_users) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
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

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        Page\twoColumns($notifyLink, $usersLink)
        .'<div class="hr"></div>'
        .Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Channel Options', $content);

}
