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

include_once 'fns/get_home_items.php';
$homeItems = get_home_items();

include_once '../../fns/Page/imageLink.php';
$items = array();
foreach ($homeItems as $item) {
    list($title, $urlPart, $propertyPart) = $item;
    $items[] = create_checkbox($user, $title, $urlPart, $propertyPart);
}

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
        'Select items to see them on your home page.',
    ))
    .join('<div class="hr"></div>', $items)
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Reorder Items',
            'Change the order in which the items appear.', '../reorder/', 'edit-home')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, $base);
