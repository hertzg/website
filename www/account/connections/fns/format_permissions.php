<?php

function format_permissions ($can_send_bookmark,
    $can_send_channel, $can_send_contact, $can_send_file,
    $can_send_note, $can_send_place, $can_send_task) {

    $html = '';

    $add = function ($condition, $grantedText, $deniedText) use (&$html) {
        if ($condition) $tag = "<span class=\"granted\">$grantedText";
        else $tag = "<span class=\"denied\">$deniedText";
        $html .= "$tag</span><br />";
    };

    $add($can_send_bookmark, 'Can send bookmarks.', 'Cannot send bookmarks.');
    $add($can_send_channel, 'Can subscribe me to his/her channels.',
        'Cannot subscribe me to his/her channels.');
    $add($can_send_contact, 'Can send contacts.', 'Cannot send contacts.');
    $add($can_send_file, 'Can send files.', 'Cannot send files.');
    $add($can_send_note, 'Can send notes.', 'Cannot send notes.');
    $add($can_send_place, 'Can send places.', 'Cannot send places.');
    $add($can_send_task, 'Can send tasks.', 'Cannot send tasks.');

    return $html;

}
