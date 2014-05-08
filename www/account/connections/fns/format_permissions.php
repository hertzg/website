<?php

function format_permissions ($can_send_bookmark, $can_send_channel,
    $can_send_contact, $can_send_file, $can_send_note, $can_send_task) {

    $denied = function (&$permissions, $text) {
        $permissions .= "<span class=\"denied\">$text</span><br />";
    };

    $granted = function (&$permissions, $text) {
        $permissions .= "<span class=\"granted\">$text</span><br />";
    };

    $html = '';

    if ($can_send_bookmark) $granted($html, 'Can send bookmarks.');
    else $denied($html, 'Cannot send bookmarks.');

    if ($can_send_channel) $granted($html, 'Can send channels.');
    else $denied($html, 'Cannot send channels.');

    if ($can_send_contact) $granted($html, 'Can send contacts.');
    else $denied($html, 'Cannot send contacts.');

    if ($can_send_file) $granted($html, 'Can send files.');
    else $denied($html, 'Cannot send files.');

    if ($can_send_note) $granted($html, 'Can send notes.');
    else $denied($html, 'Cannot send notes.');

    if ($can_send_task) $granted($html, 'Can send tasks.');
    else $denied($html, 'Cannot send tasks.');

    return $html;

}
