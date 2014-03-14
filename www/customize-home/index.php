<?php

function create_checkbox ($user, $title, $property) {
    $userProperty = "show_$property";
    if ($user->$userProperty) {
        $href = "submit-hide-$property.php";
        $icon = 'checked-checkbox';
    } else {
        $href = "submit-show-$property.php";
        $icon = 'checkbox';
    }
    return Page\imageLink($title, $href, $icon);
}

include_once '../fns/require_user.php';
$user = require_user('../');

include_once '../fns/Page/imageLink.php';

$options = array(
    create_checkbox($user, 'Bookmarks', 'bookmarks'),
    create_checkbox($user, 'Calendar', 'calendar'),
    create_checkbox($user, 'Contacts', 'contacts'),
    create_checkbox($user, 'Files', 'files'),
    create_checkbox($user, 'Notes', 'notes'),
    create_checkbox($user, 'Notifications', 'notifications'),
    create_checkbox($user, 'Tasks', 'tasks'),
);

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
