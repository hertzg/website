<?php

function create_form_items ($base, $values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ChannelName/maxLength.php";
    $maxLength = ChannelName\maxLength();

    include_once __DIR__.'/get_field_notes.php';
    $field_notes = get_field_notes();

    include_once "$fnsDir/Form/checkbox.php";
    include_once "$fnsDir/Form/textfield.php";
    return
        Form\textfield('channel_name', 'Channel name', [
            'value' => $values['channel_name'],
            'maxlength' => $maxLength,
            'autofocus' => true,
            'required' => true,
        ])
        .$field_notes['channel_name']
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'public', 'Mark as Public', $values['public'])
        .$field_notes['public']
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'receive_notifications',
            'Receive Notifications', $values['receive_notifications'])
        .$field_notes['receive_notifications'];

}
