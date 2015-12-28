<?php

namespace ViewPage;

function create ($subscribedChannel, &$scripts) {

    $id = $subscribedChannel->id;
    $fnsDir = __DIR__.'/../../../../fns';
    $items = [];

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/Form/label.php";
    $value = htmlspecialchars($subscribedChannel->channel_name);
    $items[] = \Form\label('Channel name', $value);

    if ($subscribedChannel->publisher_locked) {
        $value = htmlspecialchars($subscribedChannel->publisher_username);
        $items[] = \Form\label('Channel owner', $value);
    }

    $channel_public = $subscribedChannel->channel_public;
    $receive_notifications = $subscribedChannel->receive_notifications;

    include_once "$fnsDir/format_author.php";
    $api_key_name = $subscribedChannel->insert_api_key_name;
    $author = format_author($subscribedChannel->insert_time, $api_key_name);
    $infoText =
        ($channel_public ? 'Public' : 'Private').' channel.<br />'
        .'You are '.($receive_notifications ? '' : 'NOT ')
        .' receiving notifications from this channel.<br />'
        ."Subscribed $author.";
    if ($subscribedChannel->revision) {
        $api_key_name = $subscribedChannel->update_api_key_name;
        $author = format_author($subscribedChannel->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    $messagesKey = 'notifications/subscribed-channels/view/messages';

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Other Channels',
                'href' => "../#$id",
            ],
            "Other Channel #$id",
            \Page\sessionMessages($messagesKey)
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText)
        )
        .optionsPanel($subscribedChannel);

}
