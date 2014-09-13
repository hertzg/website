<?php

function render_checkbox_items ($base, $values, &$items) {

    include_once __DIR__.'/../../../fns/Form/checkbox.php';

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

}
