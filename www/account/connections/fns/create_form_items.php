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

    $name = 'can_send_bookmark';
    $title = 'Can send bookmarks';
    $checked = $values['can_send_bookmark'];
    $items[] = Form\checkbox($base, $name, $title, $checked);

    $name = 'can_send_channel';
    $title = 'Can send channels';
    $checked = $values['can_send_channel'];
    $items[] = Form\checkbox($base, $name, $title, $checked);

    $name = 'can_send_contact';
    $title = 'Can send contacts';
    $checked = $values['can_send_contact'];
    $items[] = Form\checkbox($base, $name, $title, $checked);

    $name = 'can_send_file';
    $title = 'Can send files';
    $checked = $values['can_send_file'];
    $items[] = Form\checkbox($base, $name, $title, $checked);

    $name = 'can_send_note';
    $title = 'Can send notes';
    $checked = $values['can_send_note'];
    $items[] = Form\checkbox($base, $name, $title, $checked);

    $name = 'can_send_task';
    $title = 'Can send tasks';
    $checked = $values['can_send_task'];
    $items[] = Form\checkbox($base, $name, $title, $checked);

    return join('<div class="hr"></div>', $items);

}
