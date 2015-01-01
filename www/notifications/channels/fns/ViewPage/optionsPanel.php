<?php

namespace ViewPage;

function optionsPanel ($channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    $id = $channel->id;

    include_once "$fnsDir/Page/imageArrowLink.php";
    $notifyLink = \Page\imageArrowLink('Post a Notification',
        "../notify/?id=$id", 'create-notification', ['id' => 'notify']);

    $title = 'Users';
    $href = "../users/?id=$id";
    $options = ['id' => 'users'];
    $num_users = $channel->num_users;
    if ($num_users) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $description = "$num_users total.";
        $usersLink = \Page\imageArrowLinkWithDescription($title,
            $description, $href, 'users', $options);
    } else {
        $usersLink = \Page\imageArrowLink($title, $href, 'users', $options);
    }

    if ($channel->receive_notifications) $icon = 'edit-channel';
    else $icon = 'edit-inactive-channel';
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/?id=$id", $icon, ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\twoColumns($notifyLink, $usersLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Channel Options', $content);

}
