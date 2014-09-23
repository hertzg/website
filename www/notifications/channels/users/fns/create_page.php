<?php

function create_page ($mysqli, $id, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    $items = [];

    include_once "$fnsDir/SubscribedChannels/indexPublisherLockedOnChannel.php";
    $subscribedChannels = SubscribedChannels\indexPublisherLockedOnChannel(
        $mysqli, $id);

    if ($subscribedChannels) {
        include_once "$fnsDir/Page/removableItem.php";
        foreach ($subscribedChannels as $subscribedChannel) {
            $itemId = $subscribedChannel->id;
            $username = $subscribedChannel->subscriber_username;
            $escapedUsername = htmlspecialchars($username);
            $href = "{$base}delete/?id=$itemId";
            $items[] =
                "<div class=\"deleteLinkWrapper\" data-id=\"$itemId\""
                ." data-username=\"$escapedUsername\">"
                    .Page\removableItem($escapedUsername, $href, 'user')
                .'</div>';
        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No users');
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "{$base}add/?id=$id";
    $options = [Page\imageArrowLink('Add User', $href, 'add-user')];

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return Page\tabs(
        [
            [
                'title' => "Channel #$id",
                'href' => "../view/?id=$id",
            ],
        ],
        'Users',
        Page\sessionMessages('notifications/channels/users/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', join('<div class="hr"></div>', $options))
    );

}
