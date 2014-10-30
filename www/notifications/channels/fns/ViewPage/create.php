<?php

namespace ViewPage;

function create ($channel) {

    $fnsDir = __DIR__.'/../../../../fns';

    $insert_time = $channel->insert_time;
    $update_time = $channel->update_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $channel->insert_api_key_name);
    $text =
        ($channel->public ? 'Public' : 'Private').' channel.<br />'
        .'You are '.($channel->receive_notifications ? '' : 'NOT ')
        .' receiving notifications from this channel.<br />'
        ."Channel created $author.";
    if ($insert_time != $update_time) {
        $api_key_name = $channel->update_api_key_name;
        $author = format_author($update_time, $api_key_name);
        $text .= "<br />Last modified $author.";
    }

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
            .\Form\label('Channel name',
                htmlspecialchars($channel->channel_name))
            .\Page\infoText(
                $text
            ),
            \Page\newItemButton('../new/', 'Channel')
        )
        .optionsPanel($channel);

}
