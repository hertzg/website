<?php

function render_checkbox_items ($values, &$items) {

    include_once __DIR__.'/../../../fns/Form/checkbox.php';

    $items[] = Form\checkbox('can_send_bookmark',
        'Can send bookmarks', $values['can_send_bookmark']);

    $items[] = Form\checkbox('can_send_channel',
        'Can subscribe me to his/her channels', $values['can_send_channel']);

    $items[] = Form\checkbox('can_send_contact',
        'Can send contacts', $values['can_send_contact']);

    $items[] = Form\checkbox('can_send_file',
        'Can send files', $values['can_send_file']);

    $items[] = Form\checkbox('can_send_note',
        'Can send notes', $values['can_send_note']);

    $items[] = Form\checkbox('can_send_place',
        'Can send places', $values['can_send_place']);

    $items[] = Form\checkbox('can_send_task',
        'Can send tasks', $values['can_send_task']);

}
