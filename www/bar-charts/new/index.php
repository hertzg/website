<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'bar-charts/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['name' => ''];

unset(
    $_SESSION['bar-charts/errors'],
    $_SESSION['bar-charts/messages'],
    $_SESSION['home/messages']
);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Bar Charts',
            'href' => ItemList\listHref(),
        ],
    ],
    'New',
    Page\sessionErrors('bar-charts/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values)
        .'<div class="hr"></div>'
        .Form\button('Save Bar Chart')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'New Bar Chart', $content, $base);
