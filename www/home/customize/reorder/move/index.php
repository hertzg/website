<?php

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

$title = $item['title'];

$fnsDir = '../../../../fns';

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'Reorder Items',
        'href' => "../#$key",
        'localNavigation' => true,
    ],
    'Move Item',
    Page\text("Where would you like to move \"<b>$title</b>\"?")
    .'<div class="hr"></div>'
    .Page\imageLink('Move to the Top',
        "submit-to-top.php?key=$key", 'move-to-top')
    .'<div class="hr"></div>'
    .Page\imageLink('Move Up', "submit-up.php?key=$key", 'move-up')
    .'<div class="hr"></div>'
    .Page\imageLink('Move Down', "submit-down.php?key=$key", 'move-down')
    .'<div class="hr"></div>'
    .Page\imageLink('Move to the Bottom',
        "submit-to-bottom.php?key=$key", 'move-to-bottom')
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Move \"$title\"", $content, '../../../../');
