<?php

namespace ViewPage;

function createPermissionsField ($apiKey) {

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

    $add('Invitations', 'invitation');
    $add('Users', 'user');
    if ($content === '') $content = 'None';

    include_once __DIR__.'/../../../../fns/Form/label.php';
    return \Form\label('Permissions', $content);
}
