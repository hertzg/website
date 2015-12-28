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
                "<a class=\"tag\" href=\"{$base}in-channel/?id=$channel->id\">"
                    .'<span class="tag-text">'
                        .htmlspecialchars($channel->channel_name)
                    .'</span>'
                    .' <span class="tag-number">'
                        ."($channel->num_notifications)"
                    .'</span>'
                .'</a>';
        }

        include_once "$fnsDir/SubscribedChannels/indexWithNotificationsOnSubscriber.php";
        $subscribedChannels = SubscribedChannels\indexWithNotificationsOnSubscriber(
            $mysqli, $id_users);
        foreach ($subscribedChannels as $subscribedChannel) {
            $href = "{$base}in-subscribed-channel/?id=$subscribedChannel->id";
            $subscribedChannel->html =
                "<a class=\"tag\" href=\"$href\">"
                    .'<span class="tag-text">'
                        .htmlspecialchars($subscribedChannel->channel_name)
                    .'</span>'
                    .' <span class="tag-number">'
                        ."($subscribedChannel->num_notifications)"
                    .'</span>'
                .'</a>';
        }

        $allChannels = array_merge($channels, $subscribedChannels);
        usort($allChannels, function ($a, $b) {
            return strcmp($a->lowercase_name, $b->lowercase_name);
        });

        if (count($channels) + count($subscribedChannels) > 1) {
            $filterBar =
                '<div class="textAndButtons">'
                    .'<span class="textAndButtons-text">'
                        .'Filter by a channel:'
                    .'</span>';
            foreach ($allChannels as $channel) {
                $filterBar .=
                    '<span class="zeroSize"> </span>'
                    .$channel->html;
            }
            $filterBar .= '</div>';
        }
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        Page\create(
            [
                'title' => 'Home',
                'href' => "$base../home/#notifications",
            ],
            'Notifications',
            Page\sessionErrors('notifications/errors')
            .Page\sessionMessages('notifications/messages')
            .$filterBar
            .join('<div class="hr"></div>', $items)
        )
        .create_panel('Options', join('<div class="hr"></div>', $options));

}
