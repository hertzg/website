<?php

function create_form_items ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ChannelName/maxLength.php";
    $maxLength = ChannelName\maxLength();

    include_once "$fnsDir/ChannelName/minLength.php";
    $minLength = ChannelName\minLength();

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('channel_name', 'Channel name', [
            'value' => $values['channel_name'],
            'maxlength' => $maxLength,
            'autofocus' => true,
            'required' => true,
        ])
        .Form\notes([
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            "Minimum $minLength maximum $maxLength characters.",
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('public', 'Mark as Public', $values['public'])
        .Form\notes([
            'If checked this will allow other users to subscribe'
            ." to this channel. Otherwise you'll have to maintain the list"
            .' of users who will receive notifications posted by you.',
        ])
        .'<div class="hr"></div>'
        .Form\checkbox('receive_notifications',
            'Receive Notifications', $values['receive_notifications'])
        .Form\notes([
            'If checked you will also receive notifications posted by you.'
            ." This is useful if you're posting"
            .' notifications from an automated system.',
        ]);

}
