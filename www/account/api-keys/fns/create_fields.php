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

    $options = [
        'none' => 'None',
        'readonly' => 'Read-only',
        'readwrite' => 'Read and write',
    ];
    include_once __DIR__.'/../../../fns/Form/select.php';
    $addAccessField = function ($name, $title) use (&$html, $options, $values) {
        $html .= Form\select($name, $title, $options, $values[$name]);
    };

    $addAccessField('bookmark_access', 'Bookmarks');
    $addAccessField('channel_access', 'Channels');
    $addAccessField('contact_access', 'Contacts');
    $addAccessField('event_access', 'Events');
    $addAccessField('file_access', 'Files');
    $addAccessField('note_access', 'Notes');
    $addAccessField('notification_access', 'Notifications');
    $addAccessField('schedule_access', 'Schedules');
    $addAccessField('task_access', 'Tasks');

    return $html;

}
