<?php

function create_permissions_field ($apiKey) {

    $content = '';
    $add = function ($title, $key) use (&$content, $apiKey) {
        $property = "can_read_{$key}s";
        if ($apiKey->$property) {
            $property = "can_write_{$key}s";
            if ($apiKey->$property) $access = 'Read and write';
            else $access = 'Read-only';
            $content .= "$title ($access)<br />";
        }
    };

    $add('Bookmarks', 'bookmark');
    $add('Channels', 'channel');
    $add('Contacts', 'contact');
    $add('Events', 'event');
    $add('Files', 'file');
    $add('Notes', 'note');
    $add('Notifications', 'notification');
    $add('Schedules', 'schedule');
    $add('Tasks', 'task');
    if ($content === '') $content = 'None';

    include_once __DIR__.'/../../../../fns/Form/label.php';
    return Form\label('Permissions', $content);
}
