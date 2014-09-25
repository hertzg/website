<?php

namespace ViewPage;

function create ($subscribedChannel) {

    $fnsDir = __DIR__.'/../../../../fns';
    $items = [];

    include_once "$fnsDir/Form/label.php";
    $value = htmlspecialchars($subscribedChannel->channel_name);
    $items[] = \Form\label('Channel name', $value);

    if ($subscribedChannel->publisher_locked) {
        $value = htmlspecialchars($subscribedChannel->publisher_username);
        $items[] = \Form\label('Channel owner', $value);
    }

    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText(
        '<div>'
            .($subscribedChannel->channel_public ? 'Public' : 'Private').' channel.'
        .'</div>'
        .'<div>'
            .'You are '.($subscribedChannel->receive_notifications ? '' : 'not ')
            .' receiving notifications from this channel.'
        .'</div>'
    );

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Other Channels',
                    'href' => '..',
                ],
            ],
            "Other Channel #$subscribedChannel->id",
            \Page\sessionMessages('notifications/subscribed-channels/view/messages')
            .join('<div class="hr"></div>', $items)
            .$infoText
        )
        .optionsPanel($subscribedChannel);

}
