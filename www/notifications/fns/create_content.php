<?php

function create_content ($mysqli, $user, $items, $options, $base) {

    $fnsDir = __DIR__.'/../../fns';

    $filterBar = '';
    if ($user->num_notifications > 1) {

        $id_users = $user->id_users;

        include_once "$fnsDir/Channels/indexWithNotificationsOnUser.php";
        $channels = Channels\indexWithNotificationsOnUser($mysqli, $id_users);
        foreach ($channels as $channel) {
            $channel->html =
                "<a class=\"tag\" href=\"in-channel/?id=$channel->id\">"
                    .htmlspecialchars($channel->channel_name)
                .'</a>';
        }

        include_once "$fnsDir/SubscribedChannels/indexWithNotificationsOnSubscriber.php";
        $subscribedChannels = SubscribedChannels\indexWithNotificationsOnSubscriber(
            $mysqli, $id_users);
        foreach ($subscribedChannels as $subscribedChannel) {
            $href = "in-subscribed-channel/?id=$subscribedChannel->id";
            $subscribedChannel->html =
                "<a class=\"tag\" href=\"$href\">"
                    .htmlspecialchars($subscribedChannel->channel_name)
                .'</a>';
        }

        $allChannels = array_merge($channels, $subscribedChannels);
        usort($allChannels, function ($a, $b) {
            return strcmp($a->lowercase_name, $b->lowercase_name);
        });

        if (count($channels) + count($subscribedChannels) > 1) {
            $filterBar =
                '<div class="greyBar textAndButtons">'
                    .'<span class="textAndButtons-text">'
                        .'Filter by a channel:'
                    .'</span>';
            foreach ($allChannels as $channel) {
                $filterBar .= $channel->html;
            }
            $filterBar .= '</div>';
        }
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/",
            ],
        ],
        'Notifications',
        Page\sessionErrors('notifications/errors')
        .Page\sessionMessages('notifications/messages')
        .$filterBar
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', join('<div class="hr"></div>', $options))
    );

}
