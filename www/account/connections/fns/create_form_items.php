<?php

function create_form_items ($base, $values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Username/maxLength.php";
    $items = [
        Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => true,
        ]),
    ];

    include_once "$fnsDir/Form/checkbox.php";

    $title = 'Can send bookmarks';
    $checked = $values['can_send_bookmark'];
    $items[] = Form\checkbox($base, 'can_send_bookmark', $title, $checked);

    $title = 'Can send channels';
    $checked = $values['can_send_channel'];
    $items[] = Form\checkbox($base, 'can_send_channel', $title, $checked);

    $title = 'Can send contacts';
    $checked = $values['can_send_contact'];
    $items[] = Form\checkbox($base, 'can_send_contact', $title, $checked);

    $title = 'Can send files';
    $checked = $values['can_send_file'];
    $items[] = Form\checkbox($base, 'can_send_file', $title, $checked);

    $title = 'Can send notes';
    $checked = $values['can_send_note'];
    $items[] = Form\checkbox($base, 'can_send_note', $title, $checked);

    $title = 'Can send tasks';
    $checked = $values['can_send_task'];
    $items[] = Form\checkbox($base, 'can_send_task', $title, $checked);

    return join('<div class="hr"></div>', $items);

}
