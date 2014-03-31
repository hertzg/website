<?php

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

$title = $item['title'];

unset($_SESSION['customize-home/reorder/messages']);

$topHref = "submit-to-top.php?key=$key";
$bottomHref = "submit-to-bottom.php?key=$key";

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../',
        ],
        [
            'title' => 'Reorder Items',
            'href' => '../',
        ],
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

include_once '../../../fns/echo_page.php';
echo_page($user, "Move \"$title\"", $content, '../../../');
