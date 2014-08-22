<?php

function create_fields ($values) {

    include_once __DIR__.'/../../../fns/Form/textfield.php';
    include_once __DIR__.'/../../../fns/Page/infoText.php';
    include_once __DIR__.'/create_expires_field.php';
    $html =
        Form\textfield('name', 'Name', [
            'value' => $values['name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_expires_field($values['expires'])
        .Page\infoText('Permissions:');

    include_once __DIR__.'/../../../fns/Form/select.php';
    $fields = [
        'bookmark' => 'Bookmarks',
        'channel' => 'Channels',
        'contact' => 'Contacts',
        'event' => 'Events',
        'file' => 'Files',
        'note' => 'Notes',
        'notification' => 'Notifications',
        'schedule' => 'Schedules',
        'task' => 'Tasks',
    ];
    foreach ($fields as $key => $value) {
        if ($key != 'bookmark') $html .= '<div class="hr"></div>';
        $html .= Form\select("{$key}_access", $value, [
            'none' => 'None',
            'readonly' => 'Read-only',
            'readwrite' => 'Read and write',
        ], $values["{$key}_access"]);
    }

    return $html;

}
