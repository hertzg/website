<?php

function create_permission_fields ($values) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/infoText.php";
    $html = Page\infoText('Permissions:');

    $options = [
        'none' => 'None',
        'readonly' => 'Read-only',
        'readwrite' => 'Read and write',
    ];

    include_once "$fnsDir/Form/select.php";
    $name = 'bar_chart_access';
    $html .= Form\select($name, 'Bar Charts', $options, $values[$name]);

    $add = function ($name, $title) use (&$html, $options, $values) {
        $html .=
            '<div class="hr"></div>'
            .Form\select($name, $title, $options, $values[$name]);
    };

    $add('bookmark_access', 'Bookmarks');
    $add('channel_access', 'Channels');
    $add('contact_access', 'Contacts');
    $add('event_access', 'Events');
    $add('file_access', 'Files');
    $add('note_access', 'Notes');
    $add('notification_access', 'Notifications');
    $add('place_access', 'Places');
    $add('schedule_access', 'Schedules');
    $add('task_access', 'Tasks');
    $add('wallet_access', 'Wallets');

    return $html;

}
