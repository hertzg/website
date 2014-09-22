<?php

namespace ViewPage;

function create ($channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Channels',
                    'href' => '..',
                ],
            ],
            "Channel #$channel->id",
            \Page\sessionMessages('notifications/channels/view/messages')
            .\Form\label('Channel name', htmlspecialchars($channel->channel_name))
            .\Page\infoText(
                '<div>'
                    .($channel->public ? 'Public' : 'Private').' channel.'
                .'</div>'
                .'<div>'
                    .'You are '.($channel->receive_notifications ? '' : 'not ')
                    .' receiving notifications from this channel.'
                .'</div>'
            ),
            \Page\newItemButton('../new/', 'Channel')
        )
        .optionsPanel($channel);

}
