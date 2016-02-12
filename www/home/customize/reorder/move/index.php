<?php

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

$title = $item['title'];

unset($_SESSION['home/customize/reorder/messages']);

$topHref = "submit-to-top.php?key=$key";
$bottomHref = "submit-to-bottom.php?key=$key";

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
    .Page\imageLink('Move to the Top', $topHref, 'move-to-top')
    .'<div class="hr"></div>'
    .Page\imageLink('Move Up', "submit-up.php?key=$key", 'move-up')
    .'<div class="hr"></div>'
    .Page\imageLink('Move Down', "submit-down.php?key=$key", 'move-down')
    .'<div class="hr"></div>'
    .Page\imageLink('Move to the Bottom', $bottomHref, 'move-to-bottom')
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Move \"$title\"", $content, '../../../../');
