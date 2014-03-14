<?php

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Page/imageLink.php';

$options = array();

if ($user->show_bookmarks) {
    $href = 'submit-hide-bookmarks.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-bookmarks.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Bookmarks', $href, $icon);

if ($user->show_calendar) {
    $href = 'submit-hide-calendar.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-calendar.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Calendar', $href, $icon);

if ($user->show_contacts) {
    $href = 'submit-hide-contacts.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-contacts.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Contacts', $href, $icon);

if ($user->show_files) {
    $href = 'submit-hide-files.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-files.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Files', $href, $icon);

if ($user->show_notes) {
    $href = 'submit-hide-notes.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-notes.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Notes', $href, $icon);

if ($user->show_notifications) {
    $href = 'submit-hide-notifications.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-notifications.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Notifications', $href, $icon);

if ($user->show_tasks) {
    $href = 'submit-hide-tasks.php';
    $icon = 'checked-checkbox';
} else {
    $href = 'submit-show-tasks.php';
    $icon = 'checkbox';
}
$options[] = Page\imageLink('Tasks', $href, $icon);

include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/warnings.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../',
        ),
        array(
            'title' => 'Account',
            'href' => '../account/',
        ),
    ),
    'Customize Home',
    Page\warnings(array(
        'Select the items that you would like to see on your Home page.',
    ))
    .join('<div class="hr"></div>', $options)
);

include_once '../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, '../');
