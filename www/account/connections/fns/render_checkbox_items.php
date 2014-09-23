<?php

function render_checkbox_items ($values, &$items) {

    include_once __DIR__.'/../../../fns/Form/checkbox.php';

    $title = 'Can send bookmarks';
    $checked = $values['can_send_bookmark'];
    $items[] = Form\checkbox('can_send_bookmark', $title, $checked);

    $title = 'Can send channels';
    $checked = $values['can_send_channel'];
    $items[] = Form\checkbox('can_send_channel', $title, $checked);

    $title = 'Can send contacts';
    $checked = $values['can_send_contact'];
    $items[] = Form\checkbox('can_send_contact', $title, $checked);

    $checked = $values['can_send_file'];
    $items[] = Form\checkbox('can_send_file', 'Can send files', $checked);

    $checked = $values['can_send_note'];
    $items[] = Form\checkbox('can_send_note', 'Can send notes', $checked);

    $checked = $values['can_send_task'];
    $items[] = Form\checkbox('can_send_task', 'Can send tasks', $checked);

}
