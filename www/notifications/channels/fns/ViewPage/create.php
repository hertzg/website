<?php

namespace ViewPage;

function create ($channel, &$scripts) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/format_author.php";
    $api_key_name = $channel->insert_api_key_name;
    $author = format_author($channel->insert_time, $api_key_name);
    $infoText =
        ($channel->public ? 'Public' : 'Private').' channel.<br />'
        .'You are '.($channel->receive_notifications ? '' : 'NOT ')
        .' receiving notifications from this channel.<br />'
        ."Channel created $author.";
    if ($channel->revision) {
        $api_key_name = $channel->update_api_key_name;
        $author = format_author($channel->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    $id = $channel->id;

    unset(
        $_SESSION['notifications/channels/edit/errors'],
        $_SESSION['notifications/channels/edit/values'],
        $_SESSION['notifications/channels/errors'],
        $_SESSION['notifications/channels/messages'],
        $_SESSION['notifications/channels/new/errors'],
        $_SESSION['notifications/channels/new/values'],
        $_SESSION['notifications/channels/post/errors'],
        $_SESSION['notifications/channels/users/messages']
    );

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Channels',
                'href' => "../#$id",
            ],
            "Channel #$id",
            \Page\sessionMessages('notifications/channels/view/messages')
            .\Form\label('Channel name',
                htmlspecialchars($channel->channel_name))
            .\Page\infoText($infoText),
            \Page\newItemButton('../new/', 'Channel')
        )
        .optionsPanel($channel);

}
