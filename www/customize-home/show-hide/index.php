<?php

function create_checkbox ($user, $title, $urlPart, $propertyPart) {
    $userProperty = "show_$propertyPart";
    if ($user->$userProperty) {
        $href = "submit-hide-$urlPart.php";
        $icon = 'checked-checkbox';
    } else {
        $href = "submit-show-$urlPart.php";
        $icon = 'checkbox';
    }
    return Page\imageLink($title, $href, $icon);
}

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Page/imageLink.php';

$options = array(
    create_checkbox($user, 'Bookmarks', 'bookmarks', 'bookmarks'),
    create_checkbox($user, 'New Bookmark', 'new-bookmark', 'new_bookmark'),
    create_checkbox($user, 'Calendar', 'calendar', 'calendar'),
    create_checkbox($user, 'Contacts', 'contacts', 'contacts'),
    create_checkbox($user, 'New Contact', 'new-contact', 'new_contact'),
    create_checkbox($user, 'Files', 'files', 'files'),
    create_checkbox($user, 'Notes', 'notes', 'notes'),
    create_checkbox($user, 'New Note', 'new-note', 'new_note'),
    create_checkbox($user, 'Notifications', 'notifications', 'notifications'),
    create_checkbox($user, 'Tasks', 'tasks', 'tasks'),
    create_checkbox($user, 'New Task', 'new-task', 'new_task'),
);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/imageLinkWithDescription.php';
include_once '../../fns/Page/warnings.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ),
        array(
            'title' => 'Customize',
            'href' => '../../customize-home/',
        ),
    ),
    'Show / Hide Items',
    Page\warnings(array(
        'Select the items that you would like to see on your home page.',
    ))
    .join('<div class="hr"></div>', $options)
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Reorder Items',
            'Change the order in which the items appear.', '../reorder/', 'edit-home')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, $base);
